<?php

namespace ZaloZns\Models;

use Illuminate\Database\Eloquent\Model;

class ZaloParam extends Model
{
    protected $table = 'zalo_template_param';
    protected $fillable = ['template_id','param_key','param_value','sort_order','title','type'];

    public function template(){
        return $this->belongsTo(ZaloTemplate::class,'template_id','id');
    }

}
