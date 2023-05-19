<?php
namespace Video\Hook;

class VideoHook
{
    public function handle(){
        echo view('wadmin-video::blocks.sidebar');
    }
}
