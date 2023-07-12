<?php
namespace Director\Hook;

class DirectorHook
{
    public function handle(){
        echo view('wadmin-director::blocks.sidebar');
    }
}
