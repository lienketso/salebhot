<?php
namespace Wallets\Models;
use Company\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Transaction\Models\Transaction;
use Users\Models\Users;

class WalletTransaction extends Model
{
    protected $table = 'wallet_transaction';
    protected $fillable = ['user_id','company_id','wallet_id','amount','transaction_type','status','transaction_id','description','admin_id'];

    public function company(){
        return $this->belongsTo(Company::class,'company_id','id');
    }
    public function getDistributor(){
        return $this->belongsTo(Company::class,'company_id','id');
    }

    public function transaction(){
        return $this->belongsTo(Transaction::class,'transaction_id','id');
    }

    public function users(){
        return $this->belongsTo(Users::class,'user_id','id');
    }
    public function admins(){
        return $this->belongsTo(Users::class,'admin_id','id');
    }

    public function wallet(){
        return $this->belongsTo(Wallets::class,'wallet_id','id');
    }

}
