<?php


namespace Contact\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Contact\Repositories\ContactRepository;
use Illuminate\Http\Request;

class ContactController extends BaseController
{
    protected $model;
    public function __construct(ContactRepository $contactRepository)
    {
        $this->model = $contactRepository;
    }

    public function getIndex(Request $request){

        $name = $request->get('name');
        if($name){
            $data = $this->model->scopeQuery(function($e) use ($name){
                return $e->orderBy('id','desc')->where('name','LIKE','%'.$name.'%')->orWhere('phone',$name);
            })->paginate(10);
        }
        else{
            $data = $this->model->orderBy('created_at','desc')->paginate(10);
        }

        return view('wadmin-contact::index',['data'=>$data]);
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
