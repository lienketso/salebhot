<?php


namespace Transaction\Models;


use Company\Models\Company;
use Discounts\Models\Discounts;
use Illuminate\Database\Eloquent\Model;
use Order\Models\OrderProduct;
use Product\Models\Factory;
use Product\Models\Catproduct;
use Users\Models\Users;

class Transaction extends Model
{
    protected $table = 'transaction';
    protected $fillable = ['user_id','company_id','company_code','category',
        'name','phone','email','license_plate','expiry','products','factory','amount','message','status','order_status','sale_admin',
        'distributor_rate','director','commission','discount_id','discount_amount','sub_total','seat_id','price','vat','sale_leader','is_completed'
    ];

    public function setAmountAttribute($value){
        $this->attributes['amount'] = str_replace(',','',$value);
    }
    public function setSubtotalAttribute($value){
        $this->attributes['sub_total'] = str_replace(',','',$value);
    }
    public function setDiscountAmountAttribute($value){
        $this->attributes['discount_amount'] = str_replace(',','',$value);
    }
    public function setPriceAttribute($value){
        $this->attributes['price'] = str_replace(',','',$value);
    }
    public function setVatttribute($value){
        $this->attributes['vat'] = str_replace(',','',$value);
    }
    public function setExpiryAttribute($value)
    {
        $this->attributes['expiry'] = convert_to_timestamp($value);
    }
    public function hang(){
        return $this->belongsTo(Factory::class,'factory','id');
    }
    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class,'transaction_id','id');
    }

    public function company(){
        return $this->belongsTo(Company::class,'company_id','id');
    }

    public function trancategory(){
        return $this->belongsTo(Catproduct::class,'category','id');
    }

    public function getCompany(){
        $com = $this->company()->first();
        if (!empty($com)) {
            return $com->name;
        } else {
            echo '<span style="color:#c00">Null</span>';
        }
    }

    public function userTran(){
        return $this->belongsTo(Users::class,'user_id','id');
    }

    public function tranStatus(){
        return $this->hasMany(TransactionStatus::class,'transaction_id','id');
    }

    public function discount(){
        return $this->belongsTo(Discounts::class,'discount_id','id');
    }

}
