<?php
namespace Gallery\Hook;

class GalleryHook
{
    public function handle(){
        echo view('wadmin-gallery::blocks.sidebar');
    }
}
