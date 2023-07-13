<?php


namespace Sales\Http\Controllers;


use App\Exports;
use Barryvdh\Debugbar\Controllers\BaseController;
use Carbon\Carbon;
use Commission\Models\Commission;
use Company\Models\Company;
use Company\Repositories\CompanyRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Location\Models\City;
use Logs\Repositories\LogsRepository;
use Maatwebsite\Excel\Facades\Excel;
use Product\Repositories\CatproductRepository;
use Setting\Repositories\SettingRepositories;
use Transaction\Models\Transaction;
use Users\Models\Users;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Intervention\Image\ImageManagerStatic as Image;
use File;

class SalesController extends BaseController
{
    protected $model;
    protected $cat;
    protected $langcode;
    protected $setting;
    protected $log;
    public function __construct(CompanyRepository $companyRepository, SettingRepositories  $settingRepositories, LogsRepository $logsRepository)
    {
        $this->model = $companyRepository;
        $this->langcode = session('lang');
        $this->setting = $settingRepositories;
        $this->log = $logsRepository;
    }

    public function export(){
        $data = Company::select('company_code', 'name','thumbnail')
            ->get();
        return Excel::download(new Exports($data), 'signaturelist.xlsx');
    }

    public function getIndex(Request $request){
        $userLog = Auth::user();
        $id = $request->get('id');
        $name = $request->get('name');
        $status = $request->get('status');
        $city = $request->get('city');
        $company_code = $request->get('company_code');
        $q = Company::query();

        if($id){
            $data = $this->model->scopeQuery(function ($e) use($id){
                return $e->orderBy('id','desc')->where('id',$id);
            })->paginate(1);
        }
        if(!is_null($name)){
            $q->where('name','LIKE','%'.$name.'%')
                ->orWhere('phone',$name)
                ->orWhere('address','LIKE','%'.$name.'%');
        }
        if(!is_null($status)){
            $q->where('status',$status);
        }
        if(!is_null($company_code)){
            $q->where('company_code',$company_code);
        }
        if(!is_null($city)){
            $q->where('city',$city);
        }
        $cities = City::orderBy('name','asc')->get();
        $data = $q->where('lang_code',$this->langcode)
            ->where('c_type','distributor')
        ->where('sale_admin',$userLog->id)
        ->orderBy('created_at','desc')->paginate(30);
        return view('wadmin-sales::index',['data'=>$data,'cities'=>$cities]);
    }

    public function getExpert(Request $request){
        $directorLogin = Auth::id();
        $q = Users::query();
        if(!is_null($request->name)){
            $q->where('name','LIKE','%'.$request->name.'%')
                ->orWhere('phone',$request->name)
                ->orWhere('address','LIKE','%'.$request->name.'%');
        }
        if(!is_null($request->city)){
            $q->where('city_id',$request->city);
        }
        $data = $q->where('parent',$directorLogin)->paginate(30);
        $cities = City::orderBy('name','asc')->get();
        return view('wadmin-director::experts',compact('data','cities'));
    }



    public function revenue(Request $request){
        $query = Transaction::query();
        $login = Auth::user();
        $mon = $request->mon;
        $thang = date('m');
        if(!is_null($mon)){
            $thang = $mon;
        }

        $query->where('order_status','active');
        $query->where('director',$login->id);
        $query->whereYear('updated_at',date('Y'));
        $query->whereMonth('updated_at',$thang);
        //tổng số đơn hàng
        $totalTransaction = $query->count();
        //tổng doanh thu
        $totalRevenue = $query->sum('sub_total');
        //Hoa hồng nhận được
        $role = $login->roles->first();
        $commission = Commission::where('role_id',$role->id)->first();
        $totalCommission = 0;
        if(!is_null($commission)){
            $totalCommission = ($commission->commission_rate/100) * $totalRevenue;
        }

        $year = date('Y'); // Năm cần lấy
        // Lấy danh sách tháng trong năm
        $monthList = collect([]);
        for ($month = 1; $month <= 12; $month++) {
            $date = Carbon::createFromDate($year, $month, 1);
            $monthList->push([
                'value' => $date->format('m'),
                'label' => $date->format('F'),
            ]);
        }

        return view('wadmin-director::revenue',compact('totalTransaction','totalRevenue','totalCommission','thang','monthList'));
    }

}
