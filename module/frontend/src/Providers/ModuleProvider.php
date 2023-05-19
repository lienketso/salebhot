<?php


namespace Frontend\Providers;


use Barryvdh\Debugbar\ServiceProvider;
use Base\Supports\Helper;
use Category\Repositories\CategoryRepository;
use Gallery\Repositories\GalleryRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Menu\Models\Menu;
use Menu\Repositories\MenuRepository;
use Post\Repositories\PostRepository;
use Product\Repositories\CatproductRepository;
use Setting\Repositories\QuicklinkRepositories;
use Setting\Repositories\SettingRepositories;

class ModuleProvider extends \Illuminate\Support\ServiceProvider
{
    protected $lang;
    public function boot(MenuRepository $menuRepository,
                         SettingRepositories $settingRepositories,
                         PostRepository $postRepository,
                         CatproductRepository $catproductRepository,
        CategoryRepository $categoryRepository,  GalleryRepository $galleryRepository, QuicklinkRepositories $quicklinkRepositories)
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views','frontend');
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
        \view()->composer('frontend::*',function ($views) use($settingRepositories,
            $postRepository,$catproductRepository, $categoryRepository, $quicklinkRepositories, $galleryRepository){
            //setting all page
            if(!$views->offsetExists('setting')){
                $setting = $settingRepositories->getAllSetting();
                $lang = \session('lang');
                $views->with(['setting'=>$setting,'lang'=>$lang]);
            }
            //page footer
            if(!$views->offsetExists('pageFoot')){
                $pageFoot = $postRepository->getPageFoot();
                $views->with(['pageFoot'=>$pageFoot]);
            }
            //catnews footer
            if(!$views->offsetExists('catNewsBlog')){
                $lang = \session('lang');
                $catNewsBlog= $categoryRepository->findWhere(['parent'=>0,'status'=>'active','lang_code'=>$lang])->take(10);
                $views->with(['catNewsBlog'=>$catNewsBlog]);
            }
            if(!$views->offsetExists('thongbao')){
                //thông báo
                $lang = \session('lang');
                $thongbao = $postRepository->findWhere(['status'=>'active','post_type'=>'page','lang_code'=>$lang])->take(20);
                $views->with(['thongbao'=>$thongbao]);
            }
            if(!$views->offsetExists('quicklinks')){
                //thông báo
                $lang = \session('lang');
                $quicklinks = DB::table('quicklinks')->orderBy('sort_order')
                    ->where('status','active')
                    ->where('display',1)
                    ->where('lang_code',$lang)->limit(10)->get();
                $views->with(['quicklinks'=>$quicklinks]);
            }
            if(!$views->offsetExists('quicklinksFooter')){
                //thông báo
                $lang = \session('lang');
                $quicklinksFooter = DB::table('quicklinks')->orderBy('sort_order')
                    ->where('status','active')
                    ->where('display',2)
                    ->where('lang_code',$lang)->limit(10)->get();
                $views->with(['quicklinksFooter'=>$quicklinksFooter]);
            }
            //video
            if(!$views->offsetExists('videoHome')){
                $lang = \session('lang');
                $videoHome = $postRepository->findWhere(['status'=>'active','display'=>1,'post_type'=>'video','lang_code'=>$lang])->take(6);
                $views->with(['videoHome'=>$videoHome]);
            }
            // banner
            if(!$views->offsetExists('banner')){
                $lang = \session('lang');
                $banner = $galleryRepository->findWhere(['status'=>'active','group_id'=>3,'lang_code'=>$lang])->take(10);
                $views->with(['banner'=>$banner]);
            }


        });
    }

    public function register()
    {
        Helper::loadModuleHelpers(__DIR__);
        $this->app->register(RouteProvider::class);
    }
}
