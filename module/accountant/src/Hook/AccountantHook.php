<?php

namespace Accountant\Hook;

class AccountantHook
{
    public function handle(){
        echo view('wadmin-accountant::blocks.sidebar');
    }
}
