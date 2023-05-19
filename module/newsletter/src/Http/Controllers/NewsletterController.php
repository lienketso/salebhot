<?php


namespace Newsletter\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Illuminate\Http\Request;
use Newsletter\Repositories\NewsletterRepository;

class NewsletterController extends BaseController
{
    protected $model;
    public function __construct(NewsletterRepository $newsletterRepository)
    {
        $this->model = $newsletterRepository;
    }

    public function getIndex(Request $request){
        $data = $this->model->orderBy('created_at','desc')->paginate(20);
        return view('wadmin-newsletter::index',['data'=>$data]);
    }

    function remove($id){
        try{
            $this->model->delete($id);
            return redirect()->back()->with('delete','Bạn vừa xóa dữ liệu !');
        }catch (\Exception $e){
            return redirect()->back()->withErrors(config('messages.error'));
        }
    }

    public function changeStatus($id){
        $input = [];
        $data = $this->model->find($id);
        if($data->status=='active'){
            $input['status'] = 'disable';
        }elseif ($data->status=='disable'){
            $input['status'] = 'active';
        }
        $this->model->update($input,$id);
        return redirect()->back();
    }

}
