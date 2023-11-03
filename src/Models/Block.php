<?php


namespace SquishCoin\Models;


class Block
{
    public string $prevHash;
    public Transaction $transaction;
    public int $ts;
    public string $hash;

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
        $this->hash = hash('sha256', json_encode($this));
    }

    /**
     * @return false|string
     */
    public function getHash(): bool|string
    {
        return $this->hash;
    }
}