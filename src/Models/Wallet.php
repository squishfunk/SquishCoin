<?php


namespace SquishCoin\Models;

use phpseclib3\Crypt\RSA;
use phpseclib3\Crypt\RSA\PrivateKey;
use phpseclib3\Crypt\RSA\PublicKey;
use phpseclib3\Crypt\Hash;

class Wallet
{
    public PublicKey $publicKey;
    private PrivateKey $privateKey;

    /**
     * Wallet constructor.
     */
    public function __construct()
    {
        $this->privateKey = RSA::createKey();
        $this->publicKey = $this->privateKey->getPublicKey();
    }

    public function sendMoney(string $amount, string $payeePublicKey): void
    {
        $transaction = new Transaction($amount, $this->publicKey->toString('PKCS8'), $payeePublicKey);
        $sign = $this->privateKey->sign($transaction);
        Chain::getInstance()->addBlock($transaction, $this->publicKey, $sign);
    }

}