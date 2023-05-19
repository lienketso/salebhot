<?php


namespace Media\Models;


use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';
    protected $fillable = ['name','table','table_id','original_name','path_name'];
}
