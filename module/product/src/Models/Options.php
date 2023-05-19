<?php


namespace Product\Models;


use Illuminate\Database\Eloquent\Model;

class Options extends Model
{
    protected $table = 'options';
    protected $fillable = [
      'product_id',
        'name',
        'visual',
        'order'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function optionValues()
    {
        return $this->hasMany(OptionValue::class,'option_id');
    }

}
