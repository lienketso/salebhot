<?php


namespace Order\Models;


use Illuminate\Database\Eloquent\Model;
use Product\Models\Product;

class OrderProduct extends Model
{
    protected $table = 'order_product';
    protected $fillable = ['order_id','product_id','qty','amount'];

    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }

}
