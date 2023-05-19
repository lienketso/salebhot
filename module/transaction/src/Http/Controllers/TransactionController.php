<?php


namespace Transaction\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Illuminate\Http\Request;
use Transaction\Models\Transaction;
use Transaction\Repositories\TransactionRepository;

class TransactionController extends BaseController
{
    protected $model;
    public function __construct(TransactionRepository $transactiontRepository)
    {
        $this->model = $transactiontRepository;
    }

    public function getIndex(Request $request){

        $name = $request->get('name');
        $company_code = $request->get('company_code');
        $status = $request->get('status');
        $q = Transaction::query();

        if(!is_null($name)){
            $q->where('name','LIKE','%'.$name.'%')->orWhere('phone',$name);
        }
        if(!is_null($company_code)){
            $q->where('company_code',$company_code);
        }
        if(!is_null($status)){
            $q->where('status',$status);
        }
        $data = $q->orderBy('created_at','desc')->paginate(20);
        return view('wadmin-transaction::index',['data'=>$data]);
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
