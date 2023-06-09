<?php

namespace Wallets\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Wallets\Models\Wallets;

class WalletRepository extends BaseRepository
{
    public function model()
    {
        return Wallets::class;
    }
}
