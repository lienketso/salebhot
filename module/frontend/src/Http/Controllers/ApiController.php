<?php

namespace Frontend\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;
use Barryvdh\Debugbar\LaravelDebugbar;
use Company\Repositories\CompanyRepository;
use Illuminate\Http\Request;
use Order\Models\OrderProduct;
use Product\Models\Product;
use Setting\Repositories\SettingRepositories;
use Transaction\Repositories\TransactionRepository;
use Users\Models\Users;

class ApiController extends BaseController
{
    protected $transaction;
    protected $com;
    protected $setting;
    public function __construct(TransactionRepository $transactionRepository, CompanyRepository $companyRepository,SettingRepositories $settingRepositories)
    {
        $this->transaction = $transactionRepository;
        $this->com = $companyRepository;
        $this->setting = $settingRepositories;
    }

    public function postBookingApi(Request $request){
        $inputs = json_decode($request->all(),true);
        $data = $this->transaction->create($inputs);
        return response()->json($data);
    }
    //get Revenua month customer
    /**
     * @SWG\Get(
     *     path="/api/get-revenua-customer",
     *     description="Trả về doanh thu tháng của người dùng",
     *     security = { { "basicAuth": {} } },
     *      tags={"Đơn hàng"},
     *     @SWG\Parameter(
     *         name="phone",
     *         in="query",
     *         type="string",
     *         description="Số điện thoại của người dùng",
     *         required=true,
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="OK",
     *     ),
     *     @SWG\Response(
     *         response=422,
     *         description="Missing Data"
     *     )
     * )
     */
    public function getRevenua(Request $request){
        $phone = $request->phone;
        $month = date('m');
        $year = date('Y');
        $totalRevenue = $this->transaction->scopeQuery(function ($e) use ($phone,$month,$year){
            return $e->where('order_status','active')
                ->where('phone',$phone)->whereMonth('updated_at',$month)->whereYear('updated_at',$year);
        })->sum('sub_total');
        return response()->json($totalRevenue);
    }

    //Số đơn hàng theo trạng thái
    /**
     * @SWG\Get(
     *     path="/api/get-transaction-by-status",
     *     description="Trả về số lượng đơn hàng theo trạng thái",
     *     security = { { "basicAuth": {} } },
     *      tags={"Đơn hàng"},
     *     @SWG\Parameter(
     *         name="phone",
     *         in="query",
     *         type="string",
     *         description="Số điện thoại của người dùng",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         name="status",
     *         in="query",
     *         type="string",
     *         description="Trạng thái ( active : Hoàn thành ; cancel : Hủy đơn, received : Đang đợi duyệt  )",
     *         required=true,
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="OK",
     *     ),
     *     @SWG\Response(
     *         response=422,
     *         description="Missing Data"
     *     )
     * )
     */
    public function getTransactionByStatus(Request $request){
        $phone = $request->phone;
        $month = date('m');
        $year = date('Y');
        $status = $request->status;
        $totalTrans = $this->transaction->scopeQuery(function ($query) use($phone,$month,$year,$status){
            return $query->where('order_status',$status)
                ->where('phone',$phone);
        })->count();
        return response()->json($totalTrans);
    }

    //Danh sách đơn hàng mới
    /**
     * @SWG\Get(
     *     path="/api/get-transaction-related",
     *     description="Lấy ra danh sách các đơn hàng mới nhất",
     *     security = { { "basicAuth": {} } },
     *      tags={"Đơn hàng"},
     *     @SWG\Parameter(
     *         name="phone",
     *         in="query",
     *         type="string",
     *         description="Số điện thoại của người dùng",
     *         required=true,
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="OK",
     *     ),
     *     @SWG\Response(
     *         response=422,
     *         description="Missing Data"
     *     )
     * )
     */
    public function getNewTransaction(Request $request){
        $phone = $request->phone;
        $transactions = $this->transaction->scopeQuery(function($e) use ($phone){
            return $e->where('phone',$phone);
        })->with('orderProduct')->limit(10);
        return response()->json($transactions);
    }

    //Hoa hồng đơn hàng theo tháng
    /**
     * @SWG\Get(
     *     path="/api/get-commission-month",
     *     description="Tiền hoa hồng trong tháng",
     *     security = { { "basicAuth": {} } },
     *      tags={"Đơn hàng"},
     *     @SWG\Parameter(
     *         name="phone",
     *         in="query",
     *         type="string",
     *         description="Số điện thoại của người dùng",
     *         required=true,
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="OK",
     *     ),
     *     @SWG\Response(
     *         response=422,
     *         description="Missing Data"
     *     )
     * )
     */
    public function totalCommission(Request $request){
        $month = date('m');
        $year = date('Y');
        $phone = $request->phone;
        $totalCommission = $this->transaction->scopeQuery(function ($e) use ($month,$year,$phone){
            return $e->where('phone',$phone)
                ->where('order_status','active')
                ->whereMonth('created_at',$month)
                ->whereYear('created_at',$year);
        })->sum('commission');
        return response()->json($totalCommission);
    }

    //Danh sách đơn hàng theo trạng thái
    /**
     * @SWG\Get(
     *     path="/api/get-transaction-list-status",
     *     description="Trả về danh sách đơn hàng theo trạng thái",
     *     security = { { "basicAuth": {} } },
     *      tags={"Đơn hàng"},
     *     @SWG\Parameter(
     *         name="phone",
     *         in="query",
     *         type="string",
     *         description="Số điện thoại của người dùng",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         name="status",
     *         in="query",
     *         type="string",
     *         description="Trạng thái ( active : Hoàn thành ; cancel : Hủy đơn, received : Đang đợi duyệt  )",
     *         required=true,
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="OK",
     *     ),
     *     @SWG\Response(
     *         response=422,
     *         description="Missing Data"
     *     )
     * )
     */
    public function getListTransaction(Request $request){
        $phone = $request->phone;
        $status = $request->status;
        $totalTrans = $this->transaction->scopeQuery(function ($query) use($phone,$status){
            return $query->where('order_status',$status)
                ->where('phone',$phone);
        })->paginate(10);
        return response()->json($totalTrans);
    }

    //form đặt hàng
    /**
     * @SWG\POST(
     *     path="/api/post-booking-service",
     *     description="Form thông tin đặt dịch vụ",
     *     security = { { "basicAuth": {} } },
     *      tags={"Đặt hàng"},
     *     @SWG\Parameter(
     *         name="phone",
     *         in="query",
     *         type="string",
     *         description="Số điện thoại khách hàng",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         name="name",
     *         in="query",
     *         type="string",
     *         description="Tên khách hàng",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         name="license_plate",
     *         in="query",
     *         type="string",
     *         description="Biển số xe",
     *         required=false,
     *     ),
     *     @SWG\Parameter(
     *         name="expiry",
     *         in="query",
     *         type="string",
     *         description="Ngày hết hạn",
     *         required=false,
     *     ),
     *     @SWG\Parameter(
     *         name="factory",
     *         in="query",
     *         type="string",
     *         description="Hãng bảo hiểm ( id hãng )",
     *         required=false,
     *     ),
     *     @SWG\Parameter(
     *         name="category",
     *         in="query",
     *         type="string",
     *         description="Loại xe",
     *         required=false,
     *     ),
     *     @SWG\Parameter(
     *         name="products",
     *         in="query",
     *         type="array",
     *         description="Sản phẩm ( Truyền vào dạng ID : 1,2,3  )",
     *         required=false,
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="OK",
     *     ),
     *     @SWG\Response(
     *         response=422,
     *         description="Missing Data"
     *     )
     * )
     */
    public function postBookingDaily(Request $request){
        $distributor_rate = intval($this->setting->getSettingMeta('commission_rate'));
        $telegrame_bot_api = $this->setting->getSettingMeta('bot_api_telegram');
        $phone = $request->phone;
        $compnayInfo = $this->com->findWhere(['phone'=>$phone])->first();
        $products = explode(',',$request->products);
        $input = [
            'name'=>$request->name,
            'phone'=>$request->phone,
            'license_plate'=>$request->license_plate,
            'expiry'=>$request->expiry,
            'message'=>$request->message,
            'factory'=>$request->factory,
            'category'=>$request->category,
            'products'=>json_encode($products),
        ];
        $input['sale_leader'] = 0;
        if($compnayInfo && $compnayInfo->c_type=='distributor'){
            $userNPP = Users::where('id', $compnayInfo->user_id)->first();
            $sale = Users::where('id', $compnayInfo->sale_admin)->first();
            $input['distributor_rate'] = $distributor_rate;
            $input['company_id'] = $compnayInfo->id;
            $input['company_code'] = $request->npp;
            $input['sale_admin'] = $compnayInfo->sale_admin;
            $input['director'] = $userNPP->parent;
            $input['sale_leader'] = 0;
        }
        $input['order_status'] = 'new';
        try {
            $transactionCreate = $this->transaction->create($input);
            $totallamount = 0;
            foreach ($products as $p) {
                $productInfo = Product::find($p);
                $totallamount = $totallamount + $productInfo->price;
                $pro = [
                    'product_id' => $p,
                    'transaction_id' => $transactionCreate->id,
                    'qty' => 1,
                    'amount' => $productInfo->price
                ];
                $order = OrderProduct::create($pro);
            }

            $vatMoney = $totallamount * 0.1;
            $sauthue = $totallamount - $vatMoney;
            $commission = $sauthue * ($distributor_rate / 100);
            $amountUp = ['amount' => $totallamount, 'commission' => $commission];
            $updateAmount = $this->transaction->update($amountUp, $transactionCreate->id);
            return response()->json(['success'=>'Đã khởi tạo đơn hàng thành công']);
        }catch (\Exception $e){
            return response()->json($e->getMessage());
        }

    }

    //Lấy thông tin người dùng
    /**
     * @SWG\Get(
     *     path="/api/get-user-infor",
     *     description="Trả về danh sách đơn hàng theo trạng thái",
     *     security = { { "basicAuth": {} } },
     *      tags={"Users"},
     *     @SWG\Parameter(
     *         name="phone",
     *         in="query",
     *         type="string",
     *         description="Số điện thoại của người dùng",
     *         required=true,
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="OK",
     *     ),
     *     @SWG\Response(
     *         response=422,
     *         description="Missing Data"
     *     )
     * )
     */
    public function getUserInfor(Request $request){
        $phone = $request->phone;
        $company = $this->com->findWhere(['phone'=>$phone])->first();
        if($company){
            return response()->json($company);
        }else{
            return response()->json(['error'=>'Không tồn tại người dùng này']);
        }
    }

}
