<?php


namespace Location\Models;


use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'district';
    protected $fillable = ['maqh','name','type','matp'];
}
