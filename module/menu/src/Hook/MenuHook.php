<?php


namespace Menu\Hook;


class MenuHook
{
    public function handle(){
        echo view('wadmin-menu::blocks.sidebar');
    }
}
