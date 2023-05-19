<?php


namespace Gallery\Models;


use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'gallery_group';
    protected $fillable = ['name','description','lang_code','status'];
}
