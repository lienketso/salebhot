<?php


namespace Product\Models;


use Illuminate\Database\Eloquent\Model;

class Catproduct extends Model
{
    protected $table='catproduct';
    protected $fillable = ['name','slug','parent','thumbnail','background','meta_title','meta_desc','sort_order','display','status','lang_code'];

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_slug($value,'-','');
    }

    public function childs()
    {
        return $this->hasMany(Catproduct::class, 'parent', 'id')->orderBy('sort_order','asc');
    }
    public function childactive(){
        return $this->hasMany(Catproduct::class, 'parent', 'id')
            ->where('display',1)
            ->orderBy('sort_order','asc');
    }
    public function getProductCat(){
        return $this->hasMany(Product::class,'cat_id')
            ->where('status','active')->limit(20);
    }

}
