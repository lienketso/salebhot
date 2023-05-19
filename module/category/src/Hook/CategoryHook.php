<?php


namespace Category\Hook;


class CategoryHook
{
    public function handle(){
        echo view('wadmin-category::blocks.sidebar');
    }
}
