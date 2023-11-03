<?php

namespace SquishCoin\Models;

class Transaction
{
    var float $amount;
    var string $payer;
    var string $payee;

    /**
     * Transaction constructor.
     * @param float $amount
     * @param string $payer
     * @param string $payee
     */
    public function __construct(float $amount, string $payer, string $payee)
    {
        $this->amount = $amount;
        $this->payer = $payer;
        $this->payee = $payee;
    }

    public function __toString(): string
    {
        return json_encode($this);
    }


}