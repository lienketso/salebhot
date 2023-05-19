<?php


namespace Order\Repositories;


use Order\Models\OrderProduct;
use Prettus\Repository\Eloquent\BaseRepository;

class OrderProductRepository extends BaseRepository
{
    public function model()
    {
        return OrderProduct::class;
    }
}
