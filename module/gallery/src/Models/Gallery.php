<?php


namespace Gallery\Models;


use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery';
    protected $fillable = ['name','group_id','title','thumbnail','link','description','sort_order','lang_code','status'];
}
