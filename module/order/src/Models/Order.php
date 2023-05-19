<?php


namespace Order\Models;


use Illuminate\Database\Eloquent\Model;
use Location\Models\City;
use Location\Models\District;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['amount','qty','customer','phone','address','city','district','payment_type','discount_percent','discount','description','status'];

    public function getCity(){
        return $this->belongsTo(City::class,'city','matp');
    }
    public function getDistrict(){
        return $this->belongsTo(District::class,'district','maqh');
    }
    public function orderProduct(){
        return $this->hasMany(OrderProduct::class,'','id');
    }

}
