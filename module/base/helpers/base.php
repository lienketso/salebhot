<?php
use Base\Supports\FlashMessage;
use Category\Models\Category;
use Illuminate\Support\Str;
use Post\Models\Post;
use Product\Models\Product;
use Illuminate\Support\Carbon;

if (!function_exists('is_in_dashboard')) {
    /**
     * @return bool
     */
    function is_in_dashboard()
    {
        $segment = request()->segment(1);
        if ($segment === config('SOURCE_ADMIN_ROUTE', 'adminlks')) {
            return true;
        }

        return false;
    }
}

if(!function_exists('menu_url')){
    function menu_url($type,$typeid){
        if($type=='blog'){
           $post = Category::find($typeid);
            return domain_url().'/blog/'.$post->slug;
        }
    }
}

if(!function_exists('percent_price')){
    function percent_price($price,$percent){
        return $price - ($price * ($percent/100));
    }
}

if(!function_exists('price_percent')){
    function price_percent($price,$disprice){
        $percent = ($disprice-$price) / $disprice * 100;
        return floor($percent);
    }
}

if (!function_exists('convert_flash_message')) {
    function convert_flash_message($mess = 'create')
    {
        switch ($mess) {
            case 'create':
                $m = config('messages.success_create');
                break;
            case 'edit':
                $m = config('messages.success_edit');
                break;
            case 'delete':
                $m = config('messages.success_delete');
                break;
            case 'cancel':
                $m = config('messages.cancel');
                break;
            case 'role':
                $m = config('messages.role_error');
                break;
            default:
                $m = config('messages.success_create');
        }

        return $m;
    }
}

if (!function_exists('upload_url')) {
    function upload_url($url){
        return env('APP_URL').'/upload/'.$url;
    }
}
if (!function_exists('public_url')) {
    function public_url($url){
        return env('APP_URL').'/'.$url;
    }
}

if (!function_exists('domain_url')) {
    function domain_url(){
        return env('APP_URL');
    }
}

if (!function_exists('replace_thumbnail')) {
    function replace_thumbnail($thumbnail){
        return str_replace(env('APP_URL').'/upload/','',$thumbnail);
    }
}


if (! function_exists('str_slug')) {
    function convert_vi_to_en($str)
    {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        //$str = str_replace(" ", "-", str_replace("&*#39;","",$str));
        return $str;
    }
}
if (! function_exists('str_slug')) {

    function str_slug($title, $separator = '-', $language = 'en')
    {
        return convert_vi_to_en(Str::slug($title, $separator, $language));
    }
}

if (! function_exists('cut_string')) {

    function cut_string($str, $int)
    {
        if(strlen($str)>$int){
            return Str::substr($str,0,$int).'...';
        }else{
            return substr($str,0,$int);
        }

    }
}



if (! function_exists('format_date')) {
    function format_date($date = '')
    {
        return date_format(new DateTime($date), 'd/m/Y');
    }
}

if (! function_exists('ngay_thang')) {
    function ngay_thang($date = '')
    {
        return date_format(new DateTime($date), 'd/m');
    }
}

if (! function_exists('format_date_full')) {
    function format_date_full($date = '')
    {
        return date_format(new DateTime($date), 'd/m/Y - h:i');
    }
}

if (! function_exists('format_hour')) {
    function format_hour($date = '')
    {
        return date_format(new DateTime($date), 'h:i');
    }
}

if(!function_exists('convert_to_timestamp')){
    function convert_to_timestamp($date){
        $time = strtotime($date);
        $newformat = date('Y-m-d h:i:s',$time);
        return $newformat;
    }
}

if(!function_exists('show_date_input')){
    function show_date_input($date){
        $time = strtotime($date);
        $newformat = date('Y-m-d',$time);
        return $newformat;
    }
}

if(!function_exists('date_now')){
    function date_now(){
        $date = Carbon::now();
        return $date;
    }
}


if (! function_exists('getProduct')) {
    function getProduct($id)
    {
        $product = Product::find($id);
        return $product;
    }
}

function sw_get_current_weekday() {
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $weekday = date("l");
    $weekday = strtolower($weekday);
    switch($weekday) {
        case 'monday':
            $weekday = 'Thứ hai';
            break;
        case 'tuesday':
            $weekday = 'Thứ ba';
            break;
        case 'wednesday':
            $weekday = 'Thứ tư';
            break;
        case 'thursday':
            $weekday = 'Thứ năm';
            break;
        case 'friday':
            $weekday = 'Thứ sáu';
            break;
        case 'saturday':
            $weekday = 'Thứ bảy';
            break;
        default:
            $weekday = 'Chủ nhật';
            break;
    }
    return $weekday.', '.date('d/m/Y');
}

function getTranStatus($status){
    $mess = '';
    switch ($status){
        case 'new':
            $mess = 'Đơn hàng mới khởi tạo';
            break;
        case 'pending':
            $mess = 'Đơn hàng đang xử lý';
            break;
        case 'received':
            $mess = 'Đã tiếp nhận đơn hàng';
            break;
        case 'active':
            $mess = 'Đơn hàng hoàn thành';
            break;
        case 'cancel':
            $mess = 'Đơn hàng hủy';
            break;
        case 'refunded':
            $mess = 'Đơn hàng hoàn lại';
            break;
        default:
            $mess = 'Đơn hàng mới khởi tạo';
            break;
    }
    return $mess;
}

function youtubeToembed($link){

    $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_]+)\??/i';
    $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))(\w+)/i';

    if (preg_match($longUrlRegex, $link, $matches)) {
        $youtube_id = $matches[count($matches) - 1];
    }

    if (preg_match($shortUrlRegex, $link, $matches)) {
        $youtube_id = $matches[count($matches) - 1];
    }
    $fullEmbedUrl = 'https://www.youtube.com/embed/' . $youtube_id ;
    return $fullEmbedUrl;
}

function GenQrCode($route){
    $pngImage = QrCode::format('svg')
        ->merge(asset('admin/themes/images/logo.png'), 0.3, true)->size(300)->errorCorrection('H')
        ->generate($route);
     return $pngImage;
}

function utf8_converter($array){
    array_walk_recursive($array, function(&$item, $key){
        if(!mb_detect_encoding($item, 'utf-8', true)){
            $item = utf8_encode($item);
        }
    });
    return $array;
}

function base64_url_encode_zalo($input) {
    return str_replace('=', '', strtr(base64_encode($input), '+/', '-_'));
}

function quickRandom($length)
{
    $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
}
