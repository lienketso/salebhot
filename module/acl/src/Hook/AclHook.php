<?php


namespace Acl\Hook;


class AclHook
{
    public function handle(){
        echo view('wadmin-acl::blocks.sidebar');
    }
}
