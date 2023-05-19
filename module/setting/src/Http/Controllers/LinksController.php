<?php


namespace Setting\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Barryvdh\Debugbar\LaravelDebugbar;
use Illuminate\Http\Request;
use Setting\Http\Requests\LinkCreateRequest;
use Setting\Models\Quicklinks;

class LinksController extends BaseController
{
    protected $langcode;
    public function __construct(Request $request, LaravelDebugbar $debugbar)
    {
        parent::__construct($request, $debugbar);
        $this->langcode = session('lang');
    }

    public function getIndex(Request $request){
        $name = $request->input('name');
        $q = Quicklinks::query();
        if($name){
            $q->where('name','LIKE','%'.$name.'%');
        }
        $data = $q->where('lang_code',$this->langcode)->orderBy('created_at','desc')->paginate(10);
        return view('wadmin-setting::quicklinks.index',compact('data'));
    }
    public function getCreate(){
        return view('wadmin-setting::quicklinks.create');
    }
    public function postCreate(LinkCreateRequest $request){
        $input = $request->except(['_token','continue_post']);
        try{
            $create = new Quicklinks();
            $create->name = $request->input('name');
            $create->link = $request->input('link');
            $create->display = $request->input('display');
            $create->sort_order = $request->input('sort_order');
            $create->target = $request->input('target');
            $create->lang_code = $this->langcode;
            $create->save();
            //continue post if click continue
            if($request->has('continue_post')){
                return redirect()
                    ->route('wadmin::link.create.get')
                    ->with('create','Thêm dữ liệu thành công');
            }
            return redirect()->route('wadmin::link.index.get')
                ->with('create','Thêm dữ liệu thành công');
        }catch (\Exception $e){
            return redirect()->back()->withErrors(config('messages.error'));
        }
    }

    public function getEdit($id){
        $data = Quicklinks::find($id);
        return view('wadmin-setting::quicklinks.edit',compact('data'));
    }

    public function postEdit($id,LinkCreateRequest $request){
        $input = $request->except(['_token','continue_post']);
        try{
            $create = Quicklinks::find($id);
            $create->name = $request->input('name');
            $create->link = $request->input('link');
            $create->display = $request->input('display');
            $create->sort_order = $request->input('sort_order');
            $create->target = $request->input('target');
            $create->save();
            //continue post if click continue
            if($request->has('continue_post')){
                return redirect()
                    ->route('wadmin::link.create.get')
                    ->with('edit','Sửa dữ liệu thành công');
            }
            return redirect()->route('wadmin::link.index.get')
                ->with('create','Sửa dữ liệu thành công');
        }catch (\Exception $e){
            return redirect()->back()->withErrors(config('messages.error'));
        }
    }

    public function delete($id){
        try{
            Quicklinks::destroy($id);
            return redirect()->back()->with('delete','Bạn vừa xóa dữ liệu !');
        }catch (\Exception $e){
            return redirect()->back()->withErrors(config('messages.error'));
        }
    }

}
