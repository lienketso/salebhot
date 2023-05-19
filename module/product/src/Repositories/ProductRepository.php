<?php


namespace Product\Repositories;


use Prettus\Repository\Eloquent\BaseRepository;
use Product\Models\Product;

class ProductRepository extends BaseRepository
{
    public function model()
    {
        return Product::class;
    }
}
