<?php


namespace Company\Repositories;


use Company\Models\Company;
use Illuminate\Http\Request;
use Prettus\Repository\Eloquent\BaseRepository;

class CompanyRepository extends BaseRepository
{
    public function model()
    {
        return Company::class;
    }


}
