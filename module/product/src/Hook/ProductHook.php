<?php
namespace Product\Hook;

class ProductHook
{
    public function handle(){
        echo view('wadmin-product::blocks.sidebar');
    }
}
