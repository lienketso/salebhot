<?php


namespace Contact\Models;


use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contact';
    protected $fillable = ['name','phone','address','email','title','messenger','status'];
}
