<?php

namespace Discounts\Hook;

class DiscountsHook
{
    public function handle(){
        echo view('wadmin-discounts::blocks.sidebar');
    }
}
