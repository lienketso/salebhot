<?php

namespace Transaction\Models;

use Illuminate\Database\Eloquent\Model;
use Users\Models\Users;

class TransactionStatus extends Model
{
    protected $table='transaction_status';
    protected $fillable = ['transaction_id','user_id','status','description','created_at'];

    public function users(){
        return $this->belongsTo(Users::class,'user_id','id');
    }

}
