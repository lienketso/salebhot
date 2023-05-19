<?php

namespace Setting\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;
use Category\Models\Category;
use Category\Models\CategoryMeta;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class SearchController extends BaseController
{
    protected $langcode;
    public function __construct()
    {
        $this->langcode = session('lang');
    }

    public function getIndex(){
        $q = CategoryMeta::query();
        $data = $q->orderBy('created_at','desc')->where('lang_code',$this->langcode)->paginate(20);
        return view('wadmin-setting::search.index',compact('data'));
    }
    public function getEdit($id){
        $data = CategoryMeta::find($id);
        $category = Category::orderBy('created_at','desc')->where('lang_code',$this->langcode)->get();
        return view('wadmin-setting::search.edit',compact('category','data'));
    }

    public function postEdit($id, Request $request){
        $input = $request->except(['_token']);
        try {
            $meta = CategoryMeta::find($id);
            $meta->meta_key = $request->meta_key;
            $meta->category = $request->category;
            $meta->status = $request->status;
            $meta->save();
            return redirect()->route('wadmin::search.index.get')
                ->with('edit','Sửa dữ liệu thành công');
        }catch (Exception $e){
            return redirect()->back()->withErrors(config('messages.error'));
        }
    }

}
