<?php


namespace Menu\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;

use Category\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Menu\Http\Requests\MenuCreateRequest;
use Menu\Http\Requests\MenuEditRequest;
use Menu\Models\Menu;
use Menu\Repositories\MenuRepository;
use Post\Repositories\PostRepository;
use Product\Repositories\CatproductRepository;
use function GuzzleHttp\Promise\all;

class MenuController extends BaseController
{
    protected $model;
    protected $blog;
    protected $page;
    protected $langcode;
    protected $cat;
    public function __construct(MenuRepository $menuRepository,
                                CategoryRepository $categoryRepository,PostRepository $postRepository, CatproductRepository $catproductRepository)
    {
       $this->model = $menuRepository;
       $this->blog = $categoryRepository;
       $this->page = $postRepository;
       $this->cat = $catproductRepository;
        $this->langcode = session('lang');
    }

    public function getIndex(Request $request){
        $menus = Menu::orderBy('sort_order','asc')->where('parent', '=', 0)
            ->where('lang_code',$this->langcode)->get();
        $menuModel = $this->model;
        //danh sách danh mục bài viết
        $listBlog = $this->blog->orderBy('sort_order','asc')
            ->where('lang_code',$this->langcode)
            ->get();
        //danh sách trang tĩnh
        $listPage = $this->page->findWhere(['post_type'=>'page','lang_code'=>$this->langcode,'status'=>'active'])->all();
        //danh sách bài viết
        $listPost = $this->page->findWhere(['post_type'=>'blog','lang_code'=>$this->langcode,'status'=>'active'])->all();
        //danh sách danh mục sản phẩm
        $listCatProduct = $this->cat->orderBy('name','asc')
            ->findWhere(['lang_code'=>$this->langcode])->all();
        return view('wadmin-menu::index',[
            'menus'=>$menus,
            'menuModel'=>$menuModel,
            'listBlog'=>$listBlog,
            'listPage'=>$listPage,
            'listPost'=>$listPost,
            'listCatProduct'=>$listCatProduct
        ]);
    }
    public function postIndex(MenuCreateRequest $request){
        $input = $request->except(['_token']);
        $input['lang_code'] = $this->langcode;
        $data = $this->model->create($input);
        return redirect()->route('wadmin::menu.index.get')
            ->with('create','Thêm dữ liệu thành công');
    }
    public function getCreate(){
       // $categories = $this->model->optionCategory(0,1,4,0,0);
        return view('wadmin-menu::create');
    }
    public function postCreate(MenuCreateRequest $request){
        try{
            $input = $request->except(['_token']);
            $data = $this->model->create($input);
            return redirect()->route('wadmin::menu.index.get')
                ->with('create','Thêm dữ liệu thành công');
        }catch (\Exception $e){
            return redirect()->back()->withErrors(config('messages.error'));
        }

    }

    function getEdit($id){
        $data = $this->model->find($id);
        //danh sách danh mục bài viết
        $listBlog = $this->blog
            ->orderBy('sort_order')
            ->where('lang_code',$this->langcode)->get();
        //danh sách trang tĩnh
        $listPage = $this->page->findWhere(['post_type'=>'page','lang_code'=>$this->langcode,'status'=>'active'])->all();
        $listPost = $this->page->findWhere(['post_type'=>'blog','lang_code'=>$this->langcode,'status'=>'active'])->all();
        //danh sách danh mục sản phẩm
        $listCatProduct = $this->cat->orderBy('name','asc')
            ->findWhere(['lang_code'=>$this->langcode])->all();
        $menuModel = $this->model;
        return view('wadmin-menu::edit',['data'=>$data,
            'listBlog'=>$listBlog,
            'listPage'=>$listPage,
            'listPost'=>$listPost,
            'menuModel'=>$menuModel,
            'listCatProduct'=>$listCatProduct
        ]);
    }

    function postEdit($id, MenuEditRequest $request){
        try{
            $input = $request->except(['_token']);

            if($request->hasFile('thumbnail')){
                $image = $request->thumbnail;
                $path = date('Y').'/'.date('m').'/'.date('d');
                $input['thumbnail'] = $path.'/'.$image->getClientOriginalName();
                $image->move('upload/'.$path,$image->getClientOriginalName());
            }
            //cấu hình seo
            if($request->meta_title==''){
                $input['meta_title'] = $request->name;
            }
            if($request->meta_desc==''){
                $input['meta_desc'] = $request->description;
            }
            $user = $this->model->update($input, $id);
            return redirect()->route('wadmin::menu.index.get')->with('edit','Bạn vừa cập nhật dữ liệu');
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
        if($data->status=='active'){
            $input['status'] = 'disable';
        }elseif ($data->status=='disable'){
            $input['status'] = 'active';
        }
        $this->model->update($input,$id);
        return redirect()->back();
    }


}
