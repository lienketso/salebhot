<?php
namespace Hook\Facades;

use Illuminate\Support\Facades\Facade;
use Hook\Supports\Actions;

class ActionsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Actions::class;
    }
}
