<?php


namespace Company\Http\Controllers;


use App\Exports;
use Barryvdh\Debugbar\Controllers\BaseController;
use Company\Http\Requests\CompanyCreateRequest;
use Company\Http\Requests\CompanyEditRequest;
use Company\Models\Company;
use Company\Repositories\CompanyRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Location\Models\City;
use Maatwebsite\Excel\Facades\Excel;
use Product\Repositories\CatproductRepository;
use Setting\Repositories\SettingRepositories;
use Users\Models\Users;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class CompanyController extends BaseController
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
        $idList = range(4037, 5038);
        $data = Company::select('company_code', 'name','thumbnail')
            ->whereIn('id',$idList)->get();
            // dd($data);
        return Excel::download(new Exports($data), 'QR-Nha-PP-2.xlsx');
    }

    public function getIndex(Request $request){
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

        $data = $q->where('lang_code',$this->langcode)->orderBy('created_at','desc')->paginate($page);
        $users = Users::orderBy('id','desc')->where('status','active')->get();
        return view('wadmin-company::index',['data'=>$data,'users'=>$users]);
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
            if($data->company_code==''){
                $input['company_code'] = $this->generateUniqueCode();
            }
            //cấu hình seo
            $nhapp = $this->model->update($input, $id);
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
        $input = [];
        $data = $this->model->find($id);
        if($data->status=='pending'){
            $input['status'] = 'active';
        }elseif ($data->status=='active'){
            $input['status'] = 'pending';
        }
        $this->model->update($input,$id);
        return redirect()->back()->with('edit','Bạn vừa duyệt nhà phân phối thành công');
    }

    public function fix(Request $request,$id){
        $data = $this->model->find($id);
        return view('wadmin-company::fix',compact('data'));
    }
    public function postfix(Request $request,$id){
        $data = $this->model->find($id);
        if($data){
            try {
                $data->status = 'disable';
                $data->description = $request->description;
                $data->save();
                return redirect()->route('wadmin::company.status.get')->with('edit','Bạn vừa sửa nhà phân phối '.$data->name);
            }catch (\Exception $e){
                return redirect()->back()->withErrors($e->getMessage());
            }

        }else{
            return redirect()->back();
        }
    }

    public function status(Request $request){
        $name = $request->get('name');
        $status = $request->get('status');
        $company_code = $request->get('company_code');
        $q = Company::query();
        if(!is_null($name)){
            $q->where('name','LIKE','%'.$name.'%');
        }
        if(!is_null($status)){
            $q->where('status',$status);
        }
        if(!is_null($company_code)){
            $q->where('company_code',$company_code);
        }

        $data = $q->where(function ($query){
            return $query->where('status','pending')->orWhere('status','disable');
        })->paginate(20);
        return view('wadmin-company::status',compact('data'));
    }

    public function accept(Request $request){
        $name = $request->get('name');
        $status = $request->get('status');
        $count = $request->get('count');
        $company_code = $request->get('company_code');
        $export = $request->get('export');
        $q = Company::query();
        $page = 20;

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
            ->where('status','active')
            ->orderBy('created_at','desc')
            ->paginate($page);
        return view('wadmin-company::accept',compact('data'));
    }

}
