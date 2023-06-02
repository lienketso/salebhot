<?php
namespace Expert\Hook;

class ExpertHook
{
    public function handle(){
        echo view('wadmin-expert::blocks.sidebar');
    }
}
