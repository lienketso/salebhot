<?php

namespace Commission\Hook;

class CommissionHook
{
    public function handle(){
        echo view('wadmin-commission::blocks.sidebar');
    }
}
