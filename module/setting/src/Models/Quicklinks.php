<?php


namespace Setting\Models;


use Illuminate\Database\Eloquent\Model;

class Quicklinks extends Model
{
    protected $table = 'quicklinks';
    protected $fillable = ['name','link','target','sort_order','display','status','lang_code'];
}
