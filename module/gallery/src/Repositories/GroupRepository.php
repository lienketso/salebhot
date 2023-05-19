<?php


namespace Gallery\Repositories;


use Gallery\Models\Group;
use Prettus\Repository\Eloquent\BaseRepository;

class GroupRepository extends BaseRepository
{
    public function model()
    {
        return Group::class;
    }
}
