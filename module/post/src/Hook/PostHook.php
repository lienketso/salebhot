<?php
namespace Post\Hook;

class PostHook
{
    public function handle(){
        echo view('wadmin-post::blocks.sidebar');
    }
}
