<?php

namespace Transaction\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Transaction\Models\TransactionStatus;

class TransactionStatusRepository extends BaseRepository
{
    public function model()
    {
        return TransactionStatus::class;
    }
}
