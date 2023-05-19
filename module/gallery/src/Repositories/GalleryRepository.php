<?php


namespace Gallery\Repositories;


use Gallery\Models\Gallery;
use Prettus\Repository\Eloquent\BaseRepository;

class GalleryRepository extends BaseRepository
{
    public function model()
    {
        return Gallery::class;
    }
}
