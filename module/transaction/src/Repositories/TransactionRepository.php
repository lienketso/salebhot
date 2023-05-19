<?php


namespace Transaction\Repositories;


use Prettus\Repository\Eloquent\BaseRepository;
use Transaction\Models\Transaction;

class TransactionRepository extends BaseRepository
{
    public function model()
    {
        return Transaction::class;
    }
}
