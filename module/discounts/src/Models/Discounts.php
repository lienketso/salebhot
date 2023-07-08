<?php

namespace Discounts\Models;

use Illuminate\Database\Eloquent\Model;

class Discounts extends Model
{
    protected $table='discounts';
    protected $fillable = ['name','thumbnail','discount_code','type_option','value','sort_order','status'];
}
