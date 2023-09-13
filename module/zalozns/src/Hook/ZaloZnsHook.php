<?php
namespace ZaloZns\Hook;
class ZaloZnsHook
{
    public function handle(){
        echo view('wadmin-zalozns::blocks.sidebar');
    }
}
