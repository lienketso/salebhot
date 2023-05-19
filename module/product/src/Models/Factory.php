<?php


namespace Product\Models;


use Illuminate\Database\Eloquent\Model;

class Factory extends Model
{
    protected $table = 'factory';
    protected $fillable = ['name','slug','description','content','thumbnail','image','link','sort_order','status','meta_title','meta_desc'];

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_slug($value,'-','');
    }

}
