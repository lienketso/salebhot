<?php

namespace Wallets\Hook;

class WalletHook
{
    public function handle(){
        echo view('wadmin-wallets::blocks.sidebar');
    }
}
