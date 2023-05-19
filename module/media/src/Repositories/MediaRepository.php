<?php


namespace Media\Repositories;


use Media\Models\Media;
use Prettus\Repository\Eloquent\BaseRepository;

class MediaRepository extends BaseRepository
{
    public function model()
    {
        return Media::class;
    }
}
