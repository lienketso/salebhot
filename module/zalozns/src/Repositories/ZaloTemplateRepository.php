<?php

namespace ZaloZns\Repositories;
use Prettus\Repository\Eloquent\BaseRepository;
use ZaloZns\Models\ZaloTemplate;

class ZaloTemplateRepository extends BaseRepository
{
    public function model()
    {
        return ZaloTemplate::class;
    }
}
