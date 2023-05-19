<?php


namespace Product\Models;


use Illuminate\Database\Eloquent\Model;

class Sku extends Model
{
    protected $table = 'skus';
    protected $fillable = ['product_id','name','barcode','price','stock'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function setPriceAttribute($value){
        $this->attributes['price'] = str_replace(',','',$value);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variants()
    {
        return $this->hasMany(Variants::class, 'sku_id');
    }

}
