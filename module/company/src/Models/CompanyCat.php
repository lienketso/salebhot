<?php


namespace Company\Models;


use Illuminate\Database\Eloquent\Model;

class CompanyCat extends Model
{
    protected $table = 'catproduct_company';
    protected $fillable = ['company_id','cat_id'];
}
