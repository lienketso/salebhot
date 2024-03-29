<?php


namespace Company\Http\Controllers;


use App\ExcelCompany;
use App\Exports;
use App\ZaloZNS;
use Barryvdh\Debugbar\Controllers\BaseController;
use Company\Http\Requests\CompanyCreateRequest;
use Company\Http\Requests\CompanyEditRequest;
use Company\Models\Company;
use Company\Repositories\CompanyRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Location\Models\City;
use Logs\Repositories\LogsRepository;
use Maatwebsite\Excel\Facades\Excel;
use Product\Repositories\CatproductRepository;
use Setting\Repositories\SettingRepositories;
use Users\Models\Users;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Wallets\Models\Wallets;
use Wallets\Repositories\WalletRepository;


class CompanyController extends BaseController
{
    protected $model;
    protected $cat;
    protected $langcode;
    protected $setting;
    protected $wallet;
    protected $log;
    public function __construct(CompanyRepository $companyRepository,
                                SettingRepositories  $settingRepositories,
                                WalletRepository $walletRepository,
                                LogsRepository $logsRepository
    )
    {
        $this->model = $companyRepository;
        $this->langcode = session('lang');
        $this->setting = $settingRepositories;
        $this->wallet = $walletRepository;
        $this->log = $logsRepository;
    }

    public function updateDirector(){
        $company = Company::where('user_id','!=',0)->get();

        foreach($company as $com){
            $user = Users::where('id',$com->user_id)->first();
            $com->sale_admin = $user->sale_admin;
//            $com->director_id = $user->parent;
            $com->save();
        }
    }

    public function createWallet(){
        $company = $this->model->where('status','active')->orWhere('status','pending')->get();
        foreach($company as $com){
            $data = [
                'company_id'=>$com->id,
            ];
            $createWallet = Wallets::create($data);
        }
        return 'done';
    }

    public function export(Request $request){
        $start = $request->start;
        $end = $request->end;
        $idList = range($start, $end);
        $data = Company::select('company_code', 'name','thumbnail')
            ->whereIn('id',$idList)->get();
            // dd($data);
        return Excel::download(new Exports($data), 'QR-Nha-PP-3.xlsx');
    }

    public function getIndex(Request $request){
        $id = $request->get('id');
        $city = $request->get('city');
        $name = $request->get('name');
        $status = $request->get('status');
        $company_code = $request->get('company_code');
        $export = $request->get('export');
        $q = Company::query();

        if(!is_null($id)){
            $q->where('id',$id);
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
            ->where('c_type','distributor')->where('status','active')
            ->orderBy('created_at','desc')->paginate(30);
        $users = Users::orderBy('id','desc')->where('status','active')->get();
        return view('wadmin-company::index',['data'=>$data,'users'=>$users,'cities'=>$cities]);
    }
    public function getCreate(CatproductRepository $catproductRepository){
        $cities = City::orderBy('name','asc')->get();
        $users = Users::orderBy('id','desc')->where('status','active')->get();
        return view('wadmin-company::create',['cities'=>$cities,'users'=>$users]);
    }
    public function postCreate(CompanyCreateRequest $request){
        try{
            $input = $request->except(['_token','continue_post']);
            if($request->hasFile('thumbnail')){
                $image = $request->thumbnail;
                $path = date('Y').'/'.date('m').'/'.date('d');
                $newnname = time().'-'.$image->getClientOriginalName();
                $newnname = convert_vi_to_en(str_replace(' ','-',$newnname));
                $input['thumbnail'] = $path.'/'.$newnname;
                $image->move('upload/'.$path,$newnname);
            }
            if($request->hasFile('cccd_mt')){
                $image = $request->cccd_mt;
                $path = date('Y').'/'.date('m').'/'.date('d');
                $newnname = time().'-'.$image->getClientOriginalName();
                $newnname = convert_vi_to_en(str_replace(' ','-',$newnname));
                $input['cccd_mt'] = $path.'/'.$newnname;
                $image->move('upload/'.$path,$newnname);
            }
            if($request->hasFile('cccd_ms')){
                $image = $request->cccd_ms;
                $path = date('Y').'/'.date('m').'/'.date('d');
                $newnname = time().'-'.$image->getClientOriginalName();
                $newnname = convert_vi_to_en(str_replace(' ','-',$newnname));
                $input['cccd_ms'] = $path.'/'.$newnname;
                $image->move('upload/'.$path,$newnname);
            }
            $input['slug'] = $request->name;
            $input['lang_code'] = $this->langcode;
            $input['company_code'] = $this->generateUniqueCode();
            $data = $this->model->create($input);

            if($request->has('continue_post')){
                return redirect()
                    ->route('wadmin::company.create.get')
                    ->with('create','Thêm dữ liệu thành công');
            }
            //logs
            $dh = '<a target="_blank" href="'.route('wadmin::company.index.get',['id'=>$data->id]).'">#NPP'.$data->id.'</a>';
            $logdata = [
                'user_id'=>\Illuminate\Support\Facades\Auth::id(),
                'action'=>'update',
                'action_id'=>$data->id,
                'module'=>'Company',
                'description'=>'Thêm đại lý mới'.$dh
            ];
            $logs = $this->log->create($logdata);
            return redirect()->route('wadmin::company.index.get',['id'=>$data->id])
                ->with('create','Thêm dữ liệu thành công');
        }catch (\Exception $e){
            return redirect()->back()->withErrors(config('messages.error'));
        }

    }

    public function generateUniqueCode()
    {
        do {
            $code = random_int(100000, 999999);
        } while (Company::where("company_code", "=", $code)->first());
        return $code;
    }

    function getEdit($id, CatproductRepository $catproductRepository){
        $userLog = Auth::user();
        $role = $userLog->roles->first();
        $data = $this->model->find($id);
        $categoryList = $catproductRepository->orderBy('sort_order')
            ->findWhere(['lang_code'=>$this->langcode])->all();
        $currentPermision = $data->category()->get()->toArray();
        $args = [];
        foreach ($currentPermision as $cat) {
            $args[] = $cat['id'];
        }
        $cities = City::orderBy('name','asc')->get();
        $users = Users::orderBy('id','desc')->where('status','active')->get();
//        $qrCode = QrCode::size(1000)->generate('https://lienketso.vn/');
//        dd($qrCode);
        $settingModel = $this->setting;
        return view('wadmin-company::edit',['data'=>$data,
            'categoryList'=>$categoryList,
            'args'=>$args,
            'cities'=>$cities,
            'users'=>$users,
            'settingModel'=>$settingModel,
            'userLog'=>$userLog,
            'role'=>$role
        ]);
    }

    function postEdit($id, CompanyEditRequest $request){
        $userLog = Auth::user();
        try{
            $input = $request->except(['_token']);
            $data = $this->model->find($id);
            if($request->hasFile('thumbnail')){
                $image = $request->thumbnail;
                $path = date('Y').'/'.date('m').'/'.date('d');
                $newnname = time().'-'.$image->getClientOriginalName();
                $newnname = convert_vi_to_en(str_replace(' ','-',$newnname));
                $input['thumbnail'] = $path.'/'.$newnname;
                $image->move('upload/'.$path,$newnname);
            }

            if($request->hasFile('cccd_mt')){
                $image = $request->cccd_mt;
                $path = date('Y').'/'.date('m').'/'.date('d');
                $newnname = time().'-'.$image->getClientOriginalName();
                $newnname = convert_vi_to_en(str_replace(' ','-',$newnname));
                $input['cccd_mt'] = $path.'/'.$newnname;
                $image->move('upload/'.$path,$newnname);
            }
            if($request->hasFile('cccd_ms')){
                $image = $request->cccd_ms;
                $path = date('Y').'/'.date('m').'/'.date('d');
                $newnname = time().'-'.$image->getClientOriginalName();
                $newnname = convert_vi_to_en(str_replace(' ','-',$newnname));
                $input['cccd_ms'] = $path.'/'.$newnname;
                $image->move('upload/'.$path,$newnname);
            }

            $input['slug'] = $request->name;
            //cấu hình seo
            $nhapp = $this->model->update($input, $id);
            //logs
            $dh = '<a target="_blank" href="'.route('wadmin::company.index.get',['id'=>$nhapp->id]).'">#NPP'.$nhapp->id.'</a>';
            $logdata = [
                'user_id'=>\Illuminate\Support\Facades\Auth::id(),
                'action'=>'update',
                'action_id'=>$nhapp->id,
                'module'=>'Company',
                'description'=>'Sửa thông tin đại lý '.$dh
            ];
            $logs = $this->log->create($logdata);
            return redirect()->route('wadmin::company.index.get')->with('edit','Bạn vừa cập nhật dữ liệu');
        }catch (\Exception $e){
            return redirect()->back()->withErrors(config('messages.error'));
        }
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
        $data = $this->model->find($id);
        $data->status = 'active';
        $data->save();

        //Gửi tin nhắn zns đến nhà phân phối khi duyệt npp thành công
        $turnZalo = $this->setting->getSettingMeta('turn_zalo');
        if($turnZalo=='on'){
            $sendZns = new ZaloZNS();
            $nguoinhan = $data->phone;
            $templateId = '267876';
            $params = [
                "ma_npp"=>$data->company_code,
                "note"=> "baohiemoto.vn",
                "so_dien_thoai"=>$data->phone,
                "customer_name"=>$data->contact_name,
                "ten_npp"=> $data->name,
            ];
            $sendZns->sendZaloMessage($templateId,$nguoinhan,$params);
        }
        //end gửi tin nhắn zns

        if(!$data->getWallet()->exists()){
            $datas = ['company_id'=>$data->id];
            $createWallet = $this->wallet->create($datas);
        }
        $dh = '<a target="_blank" href="'.route('wadmin::company.index.get',['id'=>$data->id]).'">#NPP'.$data->id.'</a>';
        $logdata = [
            'user_id'=>\Illuminate\Support\Facades\Auth::id(),
            'action'=>'publish',
            'action_id'=>$data->id,
            'module'=>'Company',
            'description'=>'Duyệt tài khoản đại lý '.$dh
        ];
        $logs = $this->log->create($logdata);

        return redirect()->back()->with('edit','Bạn vừa duyệt nhà phân phối thành công,1 tin nhắn Zalo zns thông báo được gửi tới nhà phân phối');
    }

    public function fix(Request $request,$id){
        $data = $this->model->find($id);
        return view('wadmin-company::fix',compact('data'));
    }
    public function postfix(Request $request,$id){
        $data = $this->model->find($id);
        if($data){
            try {
                $data->status = 'pending';
                $data->description = $request->description;
                $data->save();
                //logs
                $dh = '<a target="_blank" href="'.route('wadmin::company.index.get',['id'=>$data->id]).'">#NPP'.$data->id.'</a>';
                $logdata = [
                    'user_id'=>\Illuminate\Support\Facades\Auth::id(),
                    'action'=>'pending',
                    'action_id'=>$data->id,
                    'module'=>'Company',
                    'description'=>'Yêu cầu chuyên viên sửa thông tin đại lý '.$dh
                ];
                $logs = $this->log->create($logdata);
                return redirect()->route('wadmin::company.status.get')->with('edit','Bạn vừa yêu cầu sửa nhà phân phối '.$data->name);
            }catch (\Exception $e){
                return redirect()->back()->withErrors($e->getMessage());
            }

        }else{
            return redirect()->back();
        }
    }

    public function status(Request $request){
        $name = $request->get('name');
        $city = $request->get('city');
        $status = $request->get('status');
        $company_code = $request->get('company_code');
        $q = Company::query();
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
        $data = $q->where('status','pending')->where('c_type','distributor')->paginate(20);
        return view('wadmin-company::status',compact('data','cities'));
    }

    public function accept(Request $request){
        $name = $request->get('name');
        $city = $request->get('city');
        $updated = $request->get('updated');
        $company_code = $request->get('company_code');
        $export = $request->get('export');
        $q = Company::query();

        if(!is_null($name)){
            $q->where('name','LIKE','%'.$name.'%')
                ->orWhere('phone',$name)
                ->orWhere('address','LIKE','%'.$name.'%');
        }
        if(!is_null($updated)){
            $q->whereDate('updated_at',$updated);
        }
        if(!is_null($company_code)){
            $q->where('company_code',$company_code);
        }
        $cityName = '';
        if(!is_null($city)){
            $q->where('city',$city);
            $cityInfo = City::where('matp',$city)->first();
            $cityName = $cityInfo->name;
        }
        $cities = City::orderBy('name','asc')->get();
        $data = $q->where('lang_code',$this->langcode)
            ->where('c_type','distributor')
            ->where('status','active')
            ->orderBy('created_at','desc')
            ->paginate(30);
        if(!is_null($request->get('export'))){
            $exports = $q->where('lang_code',$this->langcode)
                ->where('status','active')->orderBy('created_at','desc')->paginate(5000);
            return Excel::download(new ExcelCompany($exports), 'danh-sach-dai-ly.xlsx');
        }
        return view('wadmin-company::accept',compact('data','cities','cityName'));
    }

    public function updateCode(){
        $activeCompany = $this->model->orderBy('name','asc')
            ->where('status','active')
            ->where('c_type','distributor')
            ->where('user_id','>',0)->get();

        $currentCompany = Company::orderBy('name','asc')
            ->where('status','disable')
            ->where('user_id',0)
            ->where('c_type','distributor')->get();

        return view('wadmin-company::change',compact('currentCompany','activeCompany'));
    }

    public function postUpdateCode(Request $request){
        $validated = $request->validate([
            'old_company_code' => 'required',
            'company_code' => 'required',
        ]);
        $old = $request->old_company_code;
        $new = $request->company_code;
        try {
            $oldCompany = Company::where('company_code',$old)->first();
            $oldCompany->company_code = $new;
            $oldCompany->save();
            //update company_code for new
            $newCompany = Company::where('company_code',$new)->first();
            $newCompany->company_code = $this->generateUniqueCode();
            $newCompany->save();
            return redirect()->route('wadmin::company.index.get',['id'=>$oldCompany->id])->with('create','Cập nhật mã nhà phân phối thành công');
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }

    }

}
