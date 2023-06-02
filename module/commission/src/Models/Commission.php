<?php

namespace Commission\Models;

use Acl\Models\Role;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $table = 'commissions';
    protected $fillable = ['name','role_id','product_id','commission_amount','commission_rate'];

    public function role(){
        return $this->belongsTo(Role::class,'role_id','id');
    }

}
