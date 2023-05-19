<?php

namespace Product\Models;

use Illuminate\Database\Eloquent\Model;

class ProductFactory extends Model
{
    protected $table = 'product_factory';
    protected $fillable = ['product_id','factory_id'];
}
