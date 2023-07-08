<?php

namespace Discounts\Repositories;

use Discounts\Models\Discounts;
use Prettus\Repository\Eloquent\BaseRepository;

class DiscountsRepository extends BaseRepository
{
    public function model()
    {
        return Discounts::class;
    }
}
