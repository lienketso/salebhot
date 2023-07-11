<?php

namespace Product\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Product\Models\Seats;


class SeatsRepository extends BaseRepository
{
    public function model()
    {
        return Seats::class;
    }
}
