<?php

namespace Logs\Models;

use Illuminate\Database\Eloquent\Model;
use Users\Models\Users;

class Logs extends Model
{
    protected $table = 'logs';
    protected $fillable = ['user_id','action','action_id','module','description'];

    public function users(){
        return $this->belongsTo(Users::class,'user_id','id');
    }

}
