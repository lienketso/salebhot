<?php


namespace Frontend\Http\Controllers;


use App\Mail\Order;
use Barryvdh\Debugbar\Controllers\BaseController;
use Barryvdh\Debugbar\LaravelDebugbar;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Location\Models\City;
use Location\Models\District;
use Order\Http\Requests\OrderCreateRequest;
use Order\Models\OrderProduct;
use Order\Repositories\OrderProductRepository;
use Order\Repositories\OrderRepository;
use Product\Models\Product;
use Setting\Repositories\SettingRepositories;

class OrderController extends BaseController
{
    protected $order;
    protected $orproduct;
    protected $setting;
    public function __construct(OrderRepository $orderRepository, OrderProductRepository $orderProductRepository, SettingRepositories $settingRepositories)
    {
        $this->order = $orderRepository;
        $this->orproduct = $orderProductRepository;
        $this->setting = $settingRepositories;
    }

    public function index(){
        $carts = Cart::content();
        $totalMoney = Cart::subtotal(0, '.', '.');
        $city = City::orderBy('matp')->get();

        $settingPage = $this->setting->getAllSetting();
        $discount = intval($settingPage['fact_title_1_vn']);

        $totalFloat = intval(Cart::subtotal(0, '.', ''));
        $totalDiscount = intval(($totalFloat * $discount) / 100);
        $totalDiscountText = number_format($totalDiscount,0,'.','.');

        $totalAmount = number_format($totalFloat - $totalDiscount);


        return view('frontend::cart.index',compact(
            'carts',
            'totalMoney',
            'city',
            'totalDiscount',
            'totalDiscountText',
            'totalAmount',
            'discount'
        ));
    }

    public function singleAddtocart(Request $request){
        $qty = 1;
        $id = $request->id;
        $product = Product::find($id);
        $item = Cart::add($id,$product->name,$qty,$product->price,1,['thumbnail'=>$product->thumbnail,'disprice'=>$product->disprice]);
        return redirect()->route('frontend::cart.index.get');
    }

    public function addToCart(Request $request){
        $product = Product::find($request->get('product_id'));
        $qty = $request->get('qty');
        if(!$qty){
            $qty = 1;
        }
        $item = Cart::add($product->id,$product->name,$qty,$product->price,1,['thumbnail'=>$product->thumbnail,'disprice'=>$product->disprice]);
        $count = Cart::count();
        return $count;
    }

    public function updateCart(Request $request){
        $qty = $request->get('qty');
        $rowId = $request->get('id');
        Cart::update($rowId,$qty);
    }
    public function updateQty(Request $request){
        $qty = $request->get('qty');
        $rowId = $request->get('id');
        Cart::update($rowId,$qty);
        $amount = Cart::subtotal(0, '.', '');
        return number_format($amount);
    }

    public function removeCartItem(Request $request){
        $id = $request->get('id');
        Cart::remove($id);
        $count = Cart::count();
        return $count;
    }

    public function checkout(OrderCreateRequest $request){
        $carts = Cart::content();
        $amount = Cart::subtotal(0, '.', '');
        $input = $request->except(['_token']);
        $input['amount'] = floatval($amount);
        $input['qty'] = Cart::count();
        $data = $this->order->create($input);

        foreach($carts as $cart){
            $dataP = [
              'order_id'=>$data->id,'product_id'=>$cart->id,'qty'=>$cart->qty,'amount'=>$cart->price
            ];
            $this->orproduct->create($dataP);
        }
        Cart::destroy();
        $product = OrderProduct::orderBy('created_at')->where('order_id',$data->id)->get();
        //send mail
        $dataSend = [
            'cart'=>$data,
            'products'=>$product
        ];
        Mail::to('thanhan1507@gmail.com')
                ->send(new Order($dataSend));
        if($input['payment_type']=='cod'){
            return redirect()->route('frontend::cart.success.get');
        }else{
            return redirect()->route('frontend::cart.success-bank.get')->with(['data'=>$data]);
        }

    }

    public function success(){
        return view('frontend::cart.success');
    }

    public function doCheckout(Request $request){
        $city = City::orderBy('matp')->get();
        $carts = Cart::content();
        $amount = Cart::subtotal(0, '.', '');
        return view('frontend::cart.checkout',compact('city','carts','amount'));
    }

    public function successbank(){
        $data = session('data');
        return view('frontend::cart.success-bank',compact('data'));
    }

    public function getDistrict(Request $request){
        $matp = $request->get('matp');
        $data = District::orderBy('maqh')->where('matp',$matp)->get();
        return response(['data'=>$data]);
    }

    public function orderTemplate(){
        $data = \Order\Models\Order::orderBy('created_at','desc')->first();
        $products = OrderProduct::orderBy('created_at')->where('order_id',$data->id)->get();
        return view('frontend::mail.order',compact('data','products'));
    }

}
