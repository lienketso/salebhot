<?php

namespace ZaloZns\Models;

use Illuminate\Database\Eloquent\Model;

class ZaloTemplate extends Model
{
    protected $table = 'zalo_template';
    protected $fillable = ['name','template_number','template_model','description','status'];

    public function Zparams(){
        return $this->hasMany(ZaloParam::class,'template_id','id');
    }

}
