<?php


namespace Product\Repositories;


use Prettus\Repository\Eloquent\BaseRepository;
use Product\Models\Factory;

class FactoryRepository extends BaseRepository
{
    public function model()
    {
        return Factory::class;
    }
}
