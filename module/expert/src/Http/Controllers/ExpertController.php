<?php


namespace Expert\Http\Controllers;


use App\Exports;
use Barryvdh\Debugbar\Controllers\BaseController;
use Carbon\Carbon;
use Commission\Models\Commission;
use Expert\Http\Requests\ExpertCreateRequest;
use Expert\Http\Requests\ExpertEditRequest;
use Company\Models\Company;
use Company\Repositories\CompanyRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Location\Models\City;
use Maatwebsite\Excel\Facades\Excel;
use Product\Repositories\CatproductRepository;
use Setting\Repositories\SettingRepositories;
use Transaction\Models\Transaction;
use Users\Models\Users;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Intervention\Image\ImageManagerStatic as Image;
use File;

class ExpertController extends BaseController
{
    protected $model;
    protected $cat;
    protected $langcode;
    protected $setting;
    public function __construct(CompanyRepository $companyRepository, SettingRepositories  $settingRepositories)
    {
        $this->model = $companyRepository;
        $this->langcode = session('lang');
        $this->setting = $settingRepositories;
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
        $count = $request->get('count');
        $company_code = $request->get('company_code');
        $export = $request->get('export');
        $q = Company::query();
        $page = 20;
        if($id){
            $data = $this->model->scopeQuery(function ($e) use($id){
                return $e->orderBy('id','desc')->where('id',$id);
            })->paginate(1);
        }
        if(!is_null($name)){
            $q->where('name','LIKE','%'.$name.'%');
        }
        if(!is_null($status)){
            $q->where('status',$status);
        }
        if(!is_null($company_code)){
            $q->where('company_code',$company_code);
        }
        if(!is_null($count)){
            $page = $count;
        }



        $data = $q->where('lang_code',$this->langcode)
        ->where('user_id',$userLog->id)
        ->orderBy('created_at','desc')->paginate($page);
        return view('wadmin-expert::index',['data'=>$data]);
    }
    public function getCreate(){
        $cities = City::orderBy('name','asc')->get();
        $users = Users::orderBy('id','desc')->where('status','active')->get();
        $userLog = Auth::user();
        $currentCompany = $this->model->orderBy('name','asc')
        ->where('status','disable')->where('user_id',0)->get();
        return view('wadmin-expert::create',['cities'=>$cities,'users'=>$users,'currentCompany'=>$currentCompany,'userLog'=>$userLog]);
    }
    public function postCreate(ExpertCreateRequest $request){
        try{
            $input = $request->except(['_token','continue_post']);
            $companyInfo = $this->model->findWhere(['company_code'=>$request->company_code])->first();
            $pathNew = 'upload/npp/'.$companyInfo->company_code;
            if(!File::isDirectory($pathNew)){
                File::makeDirectory($pathNew, 0777, true, true);
            }
            $paths = 'npp/'.$companyInfo->company_code;
            if($request->hasFile('thumbnail')){
                $image = $request->thumbnail;
                $newnname = time().'-'.$image->getClientOriginalName();
                $newnname = convert_vi_to_en(str_replace(' ','-',$newnname));
                $input['thumbnail'] = $paths.'/'.$newnname;

                $img = Image::make($image->path());
                $img->resize(500, 400, function ($const) {
                    $const->aspectRatio();
                })->save($pathNew.'/'.$newnname);

            }
            if($request->hasFile('cccd_mt')){
                $image = $request->cccd_mt;
                $path = date('Y').'/'.date('m').'/'.date('d');
                $newnname = time().'-'.$image->getClientOriginalName();
                $newnname = convert_vi_to_en(str_replace(' ','-',$newnname));
                $input['cccd_mt'] = $paths.'/'.$newnname;
                $img = Image::make($image->path());
                $img->resize(500, 400, function ($const) {
                    $const->aspectRatio();
                })->save($pathNew.'/'.$newnname);
            }
            if($request->hasFile('cccd_ms')){
                $image = $request->cccd_ms;
                $path = date('Y').'/'.date('m').'/'.date('d');
                $newnname = time().'-'.$image->getClientOriginalName();
                $newnname = convert_vi_to_en(str_replace(' ','-',$newnname));
                $input['cccd_ms'] = $paths.'/'.$newnname;

                $img = Image::make($image->path());
                $img->resize(500, 400, function ($const) {
                    $const->aspectRatio();
                })->save($pathNew.'/'.$newnname);
            }
            $input['slug'] = $request->name;
            $input['lang_code'] = $this->langcode;
            $input['status'] = 'pending';


            if(!empty($companyInfo)){
                $update = $this->model->update($input,$companyInfo->id);
            }

            // $data = $this->model->create($input);

            if($request->has('continue_post')){
                return redirect()
                    ->route('wadmin::expert.create.get')
                    ->with('create','Thêm dữ liệu thành công');
            }
            return redirect()->route('wadmin::expert.index.get',['id'=>$update->id])
                ->with('create','Thêm dữ liệu thành công');
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
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
        return view('wadmin-expert::edit',['data'=>$data,
            'categoryList'=>$categoryList,
            'args'=>$args,
            'cities'=>$cities,
            'users'=>$users,
            'settingModel'=>$settingModel,
            'userLog'=>$userLog,
            'role'=>$role
        ]);
    }

    function postEdit($id, ExpertEditRequest $request){
        $userLog = Auth::user();
        try{
            $input = $request->except(['_token']);
            $data = $this->model->find($id);
            $pathNew = 'upload/npp/'.$data->company_code;
            if(!File::isDirectory($pathNew)){
                File::makeDirectory($pathNew, 0777, true, true);
            }
            $paths = 'npp/'.$data->company_code;
            if($request->hasFile('thumbnail')){
                $image = $request->thumbnail;
                $newnname = time().'-'.$image->getClientOriginalName();
                $newnname = convert_vi_to_en(str_replace(' ','-',$newnname));
                $input['thumbnail'] = $paths.'/'.$newnname;


                $img = Image::make($image->path());
                $img->resize(500, 400, function ($const) {
                    $const->aspectRatio();
                })->save($pathNew.'/'.$newnname);

                // $image->move('upload/'.$paths,$newnname);
            }

            if($request->hasFile('cccd_mt')){
                $image = $request->cccd_mt;
                $newnname = time().'-'.$image->getClientOriginalName();
                $newnname = convert_vi_to_en(str_replace(' ','-',$newnname));
                $input['cccd_mt'] = $paths.'/'.$newnname;

                $img = Image::make($image->path());
                $img->resize(500, 400, function ($const) {
                    $const->aspectRatio();
                })->save($pathNew.'/'.$newnname);
            }
            if($request->hasFile('cccd_ms')){
                $image = $request->cccd_ms;
                $newnname = time().'-'.$image->getClientOriginalName();
                $newnname = convert_vi_to_en(str_replace(' ','-',$newnname));
                $input['cccd_ms'] = $paths.'/'.$newnname;

                $img = Image::make($image->path());
                $img->resize(500, 400, function ($const) {
                    $const->aspectRatio();
                })->save($pathNew.'/'.$newnname);
            }

            $input['slug'] = $request->name;
            // if($data->company_code==''){
            //     $input['company_code'] = $this->generateUniqueCode();
            // }
            //cấu hình seo
            $nhapp = $this->model->update($input, $id);
            return redirect()->route('wadmin::expert.index.get')->with('edit','Bạn vừa cập nhật dữ liệu');
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
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

    public function revenue(Request $request){
        $query = Transaction::query();
        $login = Auth::user();
        $mon = $request->mon;
        $thang = date('m');
        if(!is_null($mon)){
            $thang = $mon;
        }

        $query->where('order_status','active');
        $query->where('user_id',$login->id);
        $query->whereYear('created_at',date('Y'));
        $query->whereMonth('created_at',$thang);
        //tổng số đơn hàng
        $totalTransaction = $query->count();
        //tổng doanh thu
        $totalRevenue = $query->sum('amount');
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

        return view('wadmin-expert::revenue',compact('totalTransaction','totalRevenue','totalCommission','thang','monthList'));
    }

}
