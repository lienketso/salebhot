<?php


namespace Users\Repositories;



use Prettus\Repository\Eloquent\BaseRepository;
use Users\Models\Users;

class UsersRepository extends BaseRepository
{
    public function model()
    {
        return Users::class;
    }
}
