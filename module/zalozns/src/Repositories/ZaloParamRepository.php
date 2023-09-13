<?php

namespace ZaloZns\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use ZaloZns\Models\ZaloParam;

class ZaloParamRepository extends BaseRepository
{
    public function model()
    {
        return ZaloParam::class;
    }
}
