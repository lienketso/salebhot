<?php

namespace Logs\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;
use Barryvdh\Debugbar\LaravelDebugbar;
use Illuminate\Http\Request;
use Logs\Repositories\LogsRepository;

class LogsController extends BaseController
{
    protected $model;
    public function __construct(LogsRepository $logsRepository)
    {
        $this->model = $logsRepository;
    }

    public function getIndex(){
        $data = $this->model->orderBy('created_at','desc')->paginate(30);
        return view('wadmin-logs::index',compact('data'));
    }
}
