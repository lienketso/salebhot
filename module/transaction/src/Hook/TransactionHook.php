<?php
namespace Transaction\Hook;

class TransactionHook
{
    public function handle(){
        echo view('wadmin-transaction::blocks.sidebar');
    }
}
