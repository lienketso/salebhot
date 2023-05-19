<?php
namespace Newsletter\Hook;

class NewsletterHook
{
    public function handle(){
        echo view('wadmin-newsletter::blocks.sidebar');
    }
}
