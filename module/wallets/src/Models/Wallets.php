<?php
namespace Wallets\Models;
use Company\Models\Company;
use Illuminate\Database\Eloquent\Model;

class Wallets extends Model
{
    protected $table = 'wallets';
    protected $fillable = ['company_id','balance','send_admin'];

    public function getDistributor(){
        return $this->belongsTo(Company::class,'company_id','id');
    }


}
