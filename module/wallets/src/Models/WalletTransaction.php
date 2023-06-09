<?php
namespace Wallets\Models;
use Company\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Transaction\Models\Transaction;

class WalletTransaction extends Model
{
    protected $table = 'wallet_transaction';
    protected $fillable = ['user_id','company_id','wallet_id','amount','transaction_type','status','transaction_id'];

    public function company(){
        return $this->belongsTo(Company::class,'company_id','id');
    }

    public function transaction(){
        return $this->belongsTo(Transaction::class,'transaction_id','id');
    }

}
