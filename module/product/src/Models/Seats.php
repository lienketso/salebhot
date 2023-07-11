<?php

namespace Product\Models;

use Illuminate\Database\Eloquent\Model;

class Seats extends Model
{
    protected $table = 'seats';
    protected $fillable = ['name','seat','price','sort_order'];

    public function setPriceAttribute($value){
        $this->attributes['price'] = str_replace(',','',$value);
    }

}
