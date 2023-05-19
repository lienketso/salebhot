<?php


namespace Category\Repositories;


use Category\Models\Category;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Eloquent\BaseRepository;

class CategoryRepository extends BaseRepository
{
    public function model()
    {
        return Category::class;
    }

    public function optionCategory($id, $level,$max, $selected,$ids){
        $language = session('lang');
        $category = $this->scopeQuery(function ($e) use($id,$level,$max,$selected,$ids,$language){
           return $e->where('parent',$id)->where('lang_code',$language);
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
                    $this->optionCategory($row->id, $level+1,$max=5, $selected,$ids);
                }
            }
        }
    }

    public function optionCategoryPro($id, $level,$max, $selected,$ids,$type){
        $language = session('lang');
        $user = Auth::user();
        $category = $this->scopeQuery(function ($e) use($id,$level,$max,$selected,$ids,$language,$type,$user){
            return $e->whereIn('id',$user->category)->where('parent',$id)->where('type',$type)->where('lang_code',$language);
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
                    $this->optionCategoryPro($row->id, $level+1,$max=5, $selected,$ids,$type);
                }
            }
        }
    }

    public function getCatFoot(){
        $catFoot = $this->scopeQuery(function($e) {
            return $e->orderBy('sort_order','asc')->where('lang_code',session('lang'))
                ->where('status','active')
                ->where('display',2)
                ->get();
        })->limit(6);
        return $catFoot;
    }


}
