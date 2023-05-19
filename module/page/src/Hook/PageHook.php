<?php
namespace Page\Hook;

class PageHook
{
    public function handle(){
        echo view('wadmin-page::blocks.sidebar');
    }
}
