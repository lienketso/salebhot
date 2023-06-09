<?php
namespace Wallets\Models;
use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    protected $table = 'wallet_transaction';
    protected $fillable = ['user_id','company_id','wallet_id','amount','transaction_type','status'];
}
