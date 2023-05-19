<?php


namespace Menu\Models;


use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    protected $fillable = ['name','parent','link','type','type_id','sort_order','is_home','status','lang_code'];

    public function childs() {
        return $this->hasMany(Menu::class,'parent','id')->orderBy('sort_order','asc');
    }
}
