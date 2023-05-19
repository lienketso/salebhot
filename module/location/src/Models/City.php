<?php


namespace Location\Models;


use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'city';
    protected $fillable = ['matp','name','type','slug'];
}
