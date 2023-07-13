<?php
namespace Sales\Hook;

class SalesHook
{
    public function handle(){
        echo view('wadmin-sales::blocks.sidebar');
    }
}
