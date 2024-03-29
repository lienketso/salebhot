<?php

namespace Users\Models;

use Acl\Models\Role;
use Acl\Models\RoleUser;
use Company\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Config;
use Location\Models\City;
use Transaction\Models\Transaction;

class Users extends Authenticatable
{
    protected $table = 'users';

    protected $fillable = ['email','username','password','full_name','phone','address',
        'token','remember_token','status','thumbnail','category','parent','sale_admin','telegram','city_id','sale_leader','is_leader'];

    protected $hidden = ['password','token','remember_token'];

    // protected $casts = [
    //     'category'=>'array'
    // ];
    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }

    public function roles(){
        return $this->belongsToMany(Role::class,RoleUser::class,'user_id', 'role_id');
    }

    public function hasAnyRole($roles){
        if(is_array($roles)){
            foreach($roles as $role){
                if($this->hasRole($role)){
                    return true;
                }
            }
        }else{
            if($this->hasRole($roles)){
                return true;
            }
        }
    }
    public function hasRole($role){
        $roles = $this->roles()->where('name',$role)->count();
        if($roles==1){
            return true;
        }else{
            return false;
        }
    }

    public function getRole()
    {
        $roles = $this->roles()->first();
        if (!empty($roles)) {
            return $roles->display_name;
        } else {
            return null;
        }
    }

    public function childs() {
        return $this->hasMany(Users::class,'parent','id');
    }

    public function getTransaction(){
        return $this->hasMany(Transaction::class,'user_id','id');
    }

    public function getCompany(){
        return $this->hasMany(Company::class,'user_id','id');
    }

    public function getDistributor(){
        return $this->hasMany(Company::class,'sale_admin','id');
    }

    public function getCompanyCV(){
        return $this->getCompany()->where(function ($q){
            $q->where('status','disable')->orWhere('status','pending');
        });
    }

    public function getCompanyActive(){
        return $this->getCompany()->where(function ($q){
            $q->where('status','active');
        });
    }

    public function getCompanyPending(){
        return $this->getCompany()->where(function ($q){
            $q->where('status','pending');
        });
    }
    public function giamdocvung(){
        return $this->belongsTo(Users::class,'id','parent');
    }
    public function parents(){
        return $this->belongsTo(Users::class,'parent','id');
    }

    public function saleAdmin(){
        return $this->belongsTo(Users::class,'sale_admin','id');
    }

    public function chuyenvien(){
        return $this->belongsTo(Users::class,'id','sale_admin');
    }

    public function city(){
        return $this->belongsTo(City::class,'city_id','matp');
    }

    public function distributor()
    {
        return $this->belongsTo(Company::class,'sale_admin','id');
    }

}
