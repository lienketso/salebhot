<?php


namespace Hook\Facades;
use Hook\Supports\Filters;
use Illuminate\Support\Facades\Facade;

class FiltersFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Filters::class;
    }
}
