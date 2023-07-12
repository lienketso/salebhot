<?php


namespace Director\Repositories;


use Company\Models\Company;
use Illuminate\Http\Request;
use Prettus\Repository\Eloquent\BaseRepository;

class DirectorRepository extends BaseRepository
{
    public function model()
    {
        return Company::class;
    }


}
