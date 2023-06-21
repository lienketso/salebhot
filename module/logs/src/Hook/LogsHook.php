<?php

namespace Logs\Hook;

class LogsHook
{
    public function handle(){
        echo view('wadmin-logs::blocks.sidebar');
    }
}
