<?php


namespace Product\Models;


use Illuminate\Database\Eloquent\Model;

class OptionValue extends Model
{
    protected $table = 'option_values';
    protected $fillable = ['product_id','option_id','value','label'];

    public function option()
    {
        return $this->belongsTo(Options::class);
    }
}
