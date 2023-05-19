<?php
namespace Project\Hook;

class ProjectHook
{
    public function handle(){
        echo view('wadmin-project::blocks.sidebar');
    }
}
