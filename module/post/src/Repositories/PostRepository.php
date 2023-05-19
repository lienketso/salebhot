<?php


namespace Post\Repositories;


use Post\Models\Post;
use Post\Models\PostMeta;
use Prettus\Repository\Eloquent\BaseRepository;

class PostRepository extends BaseRepository
{
    public function model()
    {
        return Post::class;
    }

    public function getSinglePost($slug){
        $post = $this->findWhere(['slug'=>$slug])->first();
        return $post;
    }

    public function getPageFoot(){
        $pageFoot = $this->scopeQuery(function($e){
            return $e->orderBy('created_at','desc')->where('lang_code',session('lang'))
                ->where('status','active')->where('post_type','page')->get();
        })->limit(5);
        return $pageFoot;
    }

    public function getLatestPost(){
        $latest = $this->scopeQuery(function($e){
            return $e->orderBy('created_at','desc')->where('post_type','blog')
                ->where('lang_code',session('lang'));
        })->limit(5);
        return $latest;
    }

    public function setMeta($data,$id){
        foreach($data as $key=>$val){
            $name = json_decode($val);
            PostMeta::create(['post_id'=>$id,'meta_key'=>$key,'meta_value'=>$val,'name'=>$name->name]);
        }
    }

    public function updateMeta($data,$id){
        foreach($data as $key=>$val) {
            $name = \GuzzleHttp\json_decode($val);
            $newUser = tap(PostMeta::firstOrNew(['post_id' => $id,'meta_key'=>$key]), function ($newUser) use ($id,$key,$val,$name) {
                $newUser->fill([
                    'post_id' => $id,
                    'meta_key'=> $key,
                    'meta_value' => $val,
                    'name'=>$name->name
                ])->save();
            });
        }
    }

    public function getPostMeta($key,$id){
        $data = collect(['meta_value' => '']);
        $setting = PostMeta::where('meta_key',$key)->where('post_id',$id)->first();
        if (!empty($setting)) {
            $data = $setting->meta_value;
        }else{
            $data = 'null';
        }
        return $data;
    }

    public function getPostMetaJson($key,$sub,$id){
        $data = collect(['meta_value' => '']);
        $setting = PostMeta::where('meta_key',$key)->where('post_id',$id)->first();
        if (!empty($setting)) {
            $data = json_decode($setting->meta_value);
            $data = $data->$sub;
        }else{
            $data = 'null';
        }
        return $data;
    }

}
