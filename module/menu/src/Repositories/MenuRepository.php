<?php


namespace Menu\Repositories;


use Illuminate\Support\Facades\Session;
use Menu\Models\Menu;
use Prettus\Repository\Eloquent\BaseRepository;

class MenuRepository extends BaseRepository
{
    public function model()
    {
        return Menu::class;
    }

    public function optionMenu($id, $level,$max, $selected,$ids){
        $category = $this->scopeQuery(function ($e) use($id,$level,$max,$selected,$ids){
            return $e->where('parent',$id)->where('lang_code',session('lang'));
        })->all();
        if($category){
            foreach ($category as $row){
                echo "<option value='".$row->id."'";
                if($selected==$row->id){
                    echo " selected=''";
                }
                if($row->id==$ids){
                    echo " disabled=''";
                }
                echo">".str_repeat("<span>&brvbar;---</span>",$level-1).$row->name."</option>";
                if($level<$max){
                    $this->optionMenu($row->id, $level+1,$max=5, $selected,$ids);
                }
            }
        }
    }

    function getMenu($lang){
       $menuWise = $this->scopeQuery(function ($e) use ($lang){
          return $e->where('status','active')->where('parent',0)->where('lang_code',$lang);
       })->all();
//        $menuWise = Menu::where(['status'=>'active','parent'=>0,'lang_code'=>session('lang')])
//            ->orderBy('sort_order','asc')->get();
        return $menuWise;
    }

}
