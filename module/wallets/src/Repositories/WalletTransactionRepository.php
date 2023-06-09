<?php

namespace Wallets\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Wallets\Models\WalletTransaction;

class WalletTransactionRepository extends BaseRepository
{
    public function model()
    {
        return WalletTransaction::class;
    }
}
