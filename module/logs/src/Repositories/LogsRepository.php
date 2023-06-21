<?php

namespace Logs\Repositories;

use Logs\Models\Logs;
use Prettus\Repository\Eloquent\BaseRepository;

class LogsRepository extends BaseRepository
{
    public function model()
    {
        return Logs::class;
    }
}
