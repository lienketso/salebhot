<?php
namespace Company\Hook;

class CompanyHook
{
    public function handle(){
        echo view('wadmin-company::blocks.sidebar');
    }
}
