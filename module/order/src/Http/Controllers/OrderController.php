<?php


namespace Order\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Barryvdh\Debugbar\LaravelDebugbar;
use Illuminate\Http\Request;
use Order\Models\Order;
use Order\Repositories\OrderRepository;

class OrderController extends BaseController
{
    protected $order;
    public function __construct(OrderRepository $orderRepository)
    {
        $this->order = $orderRepository;
    }

    public function getIndex(){
        $q = Order::query();
        $data = $q->with('orderProduct')->orderBy('created_at','desc')->paginate(20);
        return view('wadmin-order::index',compact('data'));
    }

    public function update($id){
        $data = Order::find($id);
        if(!$data){
            redirect()->back()->with(['error'=>'Không tồn tại đơn hàng']);
        }
        if($data->status=='pending'){
            $this->order->update(['status'=>'completed'],$id);
        }else{
            $this->order->update(['status'=>'pending'],$id);
        }
        return redirect()->back();
    }

}
