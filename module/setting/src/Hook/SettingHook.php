<?php
namespace Setting\Hook;

class SettingHook
{
    public function handle(){
        echo view('wadmin-setting::blocks.sidebar');
    }
}
