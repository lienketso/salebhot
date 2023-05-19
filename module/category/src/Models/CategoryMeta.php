<?php

namespace Category\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryMeta extends Model
{
    protected $table = 'category_meta';
    protected $fillable = ['category','meta_key','meta_value','lang_code'];

    public function cate(){
        return $this->hasOne(Category::class,'id','category');
    }

}
