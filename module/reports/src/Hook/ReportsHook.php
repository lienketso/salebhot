<?php

namespace Reports\Hook;

class ReportsHook
{
    public function handle(){
        echo view('wadmin-report::blocks.sidebar');
    }
}
