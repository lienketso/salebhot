<?php


namespace Newsletter\Repositories;


use Newsletter\Models\Newsletter;
use Prettus\Repository\Eloquent\BaseRepository;

class NewsletterRepository extends BaseRepository
{
    public function model()
    {
        return Newsletter::class;
    }
}
