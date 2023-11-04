<?php


namespace SquishCoin\Models;


use phpseclib3\Crypt\Hash;

class Block
{
    public string $prevHash;
    public Transaction $transaction;
    public int $ts;
    public bool|string $hash;
    public int $nonce;

    /**
     * Block constructor.
     * @param string $prevHash
     * @param Transaction $transaction
     * @param int $ts
     */
    public function __construct(string $prevHash, Transaction $transaction)
    {
        $this->prevHash = $prevHash;
        $this->transaction = $transaction;

        $this->ts = time();
        $this->hash = (new Hash('sha256'))->hash($this);
        $this->nonce = mt_rand(0, 999999999);
    }

    /**
     * @return false|string
     */
    public function getHash(): bool|string
    {
        return $this->hash;
    }

    public function __toString(): string
    {
        return json_encode($this);
    }


}