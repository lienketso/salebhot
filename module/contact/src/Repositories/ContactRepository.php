<?php


namespace Contact\Repositories;


use Contact\Models\Contact;
use Prettus\Repository\Eloquent\BaseRepository;

class ContactRepository extends BaseRepository
{
    public function model()
    {
        return Contact::class;
    }
}
