<?php


namespace Users\Hook;


class UsersHook
{
    public function handle(){
        echo view('wadmin-users::blocks.sidebar');
    }
}
