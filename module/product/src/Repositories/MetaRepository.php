<?php


namespace Product\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Product\Models\ProductMeta;

class MetaRepository extends BaseRepository
{
    public function model()
    {
        return ProductMeta::class;
    }
}
