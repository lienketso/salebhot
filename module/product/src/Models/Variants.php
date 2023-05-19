<?php


namespace Product\Models;


use Illuminate\Database\Eloquent\Model;

class Variants extends Model
{
    protected $table = 'variants';
    protected $fillable = ['product_id','sku_id','option_id','option_value_id'];

    public function option()
    {
        return $this->belongsTo(Options::class);
    }

    public function optionValue()
    {
        return $this->belongsTo(OptionValue::class);
    }

}
