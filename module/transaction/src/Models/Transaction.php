<?php


namespace Transaction\Models;


use Company\Models\Company;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction';
    protected $fillable = ['user_id','company_id','company_code','name','phone','email','license_plate','expiry','products','message','status'];


    public function setExpiryAttribute($value)
    {
        $this->attributes['expiry'] = convert_to_timestamp($value);
    }

    public function company(){
        return $this->belongsTo(Company::class,'company_id','id');
    }

    public function getCompany(){
        $com = $this->company()->first();
        if (!empty($com)) {
            return $com->name;
        } else {
            echo '<span style="color:#c00">Null</span>';
        }
    }

}
