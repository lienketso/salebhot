<?php
namespace ZaloZns\Http\Controllers;
use Barryvdh\Debugbar\Controllers\BaseController;
use Barryvdh\Debugbar\LaravelDebugbar;
use Illuminate\Http\Request;
use ZaloZns\Http\Requests\ZaloZnsCreateRequest;
use ZaloZns\Http\Requests\ZaloZnsEditRequest;
use ZaloZns\Models\ZaloParam;
use ZaloZns\Models\ZaloTemplate;
use ZaloZns\Repositories\ZaloTemplateRepository;

class ZaloZnsController extends BaseController
{
    protected $zalo;
    public function __construct(ZaloTemplateRepository $zaloTemplateRepository)
    {
        $this->zalo = $zaloTemplateRepository;
    }

    public function getIndex(){
        $data = $this->zalo->orderBy('created_at','desc')->paginate(20);
        return view('wadmin-zalozns::index',compact('data'));
    }
    public function getCreate(){
        return view('wadmin-zalozns::create');
    }
    public function postCreate(ZaloZnsCreateRequest $request){
        $input = $request->except(['_token']);
        try {
            $data = $this->zalo->create($input);
            return redirect()->route('wadmin::zalozns.index.get')->with(['create'=>'Thêm template thành công']);
        }catch (\Exception $exception){
            return redirect()->back()->with(['errors'=>$exception->getMessage()]);
        }
    }
    public function getEdit($id){
        $data = $this->zalo->find($id);
        return view('wadmin-zalozns::edit',compact('data'));
    }
    public function postEdit($id,ZaloZnsEditRequest $request){
        $input = $request->except(['_token']);
        try {
            $data = $this->zalo->update($input,$id);
            return redirect()->route('wadmin::zalozns.index.get')->with(['edit'=>'Sửa template thành công']);
        }catch (\Exception $exception){
            return redirect()->back()->with(['errors'=>$exception->getMessage()]);
        }
    }
    public function getDelete($id){
        try{
            $this->zalo->delete($id);
            return redirect()->back()->with('delete','Bạn vừa xóa dữ liệu !');
        }catch (\Exception $e){
            return redirect()->back()->withErrors(config('messages.error'));
        }
    }

    //danh sách tham số
    public function getParamIndex($id){
        $template = $this->zalo->find($id);
        $q = ZaloParam::query();
        $data = $q->orderBy('created_at','desc')->where('template_id',$id)->paginate(20);
        return view('wadmin-zalozns::param.index',compact('data','template'));
    }
    public function getParamCreate($id){
        $template = $this->zalo->find($id);
        return view('wadmin-zalozns::param.create',compact('template'));
    }
    public function postParamCreate($id, Request $request){
        $input = $request->except(['_token']);
        $template = $this->zalo->find($id);
        $validated = $request->validate([
            'param_key' => 'required',
            'param_value' => 'required',
        ]);
        $input['template_id'] = $template->id;
        try {
            $data = ZaloParam::create($input);
            return redirect()->route('wadmin::zalozns.param.index',$template->id)->with(['create'=>'Thêm tham số thành công']);
        }catch (\Exception $exception){
            return redirect()->back()->with(['errors'=>$exception->getMessage()]);
        }
    }

    public function getParamEdit($id){
        $data = ZaloParam::find($id);
        return view('wadmin::zalozns.param.edit',compact('data'));
    }

}
