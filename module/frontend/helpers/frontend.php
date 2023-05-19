<?php

use Menu\Models\Menu;
use Product\Models\Catproduct;

function getAllmenu(){
    $lang = session('lang');
    $menuWise = Menu::orderBy('sort_order','asc')
        ->where('lang_code',$lang)->where('status','active')->where('parent',0)
        ->get();
    return $menuWise;
}

function sub($str,$num){
    return mb_substr(strip_tags($str), 0, $num);
}

function getAllCategory(){
		$lang = session('lang');
		$catAll = Catproduct::orderBy('sort_order','asc')
        ->where('lang_code',$lang)->where('status','active')->where('parent',0)
        ->get();
        return $catAll;
    }
function stringDate($time){
    $time = strtotime($time);
    return date('d',$time) .' tháng '.date('m',$time).' ,'.date('Y',$time);
}
