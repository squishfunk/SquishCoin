<?php


namespace SquishCoin\Models;


class Chain
{
    /**
     * @var Chain
     */
    private static Chain $instance;

    /**
     * @var Block[]
     */
    private array $chain;

    private function __construct(){
        $this->chain = [
            new Block('', new Transaction(100,'genesis', 'squishfunk'))
        ];
    }

    public static function getInstace(): Chain
    {
        if(self::$instance == null){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getLastBlock(){
        return end($this->chain);
    }

    /**
     * Add block on the chain
     * @param Transaction $transaction
     */
    public function addBlock(Transaction $transaction){
        $newBlock = new Block($this->getLastBlock()->getHash(), $transaction);
        $this->chain[] = $newBlock;
    }
}