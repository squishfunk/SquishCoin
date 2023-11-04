<?php


namespace SquishCoin\Models;


use phpseclib3\Crypt\Hash;
use phpseclib3\Crypt\RSA\PublicKey;

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

    public static function getInstance(): Chain
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @return false|Block
     */
    public function getLastBlock(){
        return end($this->chain);
    }

    /**
     * Add block on the chain
     * @param Transaction $transaction
     */
    public function addBlock(Transaction $transaction, PublicKey $payerPublicKey, string $sign){
        $isTansactionFromUser = $payerPublicKey->verify($transaction, $sign);
        if($isTansactionFromUser){
            $newBlock = new Block($this->getLastBlock()->getHash(), $transaction);
            $solution = $this->mine($newBlock->nonce); /* TODO Verify solution*/
            $this->chain[] = $newBlock;
        }
    }

    protected function mine(int $nonce){
        $solution = 1;
        echo 'Mining...';

        while(true){
            $hash_algo = new Hash('md5');
            $str_hash = $hash_algo->hash($nonce + $solution);

            if(substr($str_hash, 0, 4) == '0000'){
                return $solution;
            }

            $solution++;
        }


    }
}