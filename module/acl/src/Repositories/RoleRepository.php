<?php


namespace Acl\Repositories;


use Acl\Models\Role;
use Prettus\Repository\Eloquent\BaseRepository;

class RoleRepository extends BaseRepository
{
    public function model()
    {
        return Role::class ;
    }
}
