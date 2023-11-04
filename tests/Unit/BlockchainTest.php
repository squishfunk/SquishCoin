<?php


namespace Tests\Unit;


use PHPUnit\Framework\TestCase;
use SquishCoin\Models\Chain;
use SquishCoin\Models\Wallet;

class BlockchainTest extends TestCase
{
    public function test_transaction_on_blockchain(): void
    {
        $andrzejWallet = new Wallet();
        $agnieszkaWallet = new Wallet();

        $andrzejWallet->sendMoney(50, $agnieszkaWallet->publicKey->toString('PKCS8'));

        $lastBlock = Chain::getInstance()->getLastBlock();

        $this->assertEquals($lastBlock->transaction->amount, 50);
        $this->assertEquals($lastBlock->transaction->payee, $agnieszkaWallet->publicKey->toString('PKCS8'));
        $this->assertEquals($lastBlock->transaction->payer, $andrzejWallet->publicKey->toString('PKCS8'));
    }
}