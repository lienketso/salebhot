<?php


namespace Product\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Company\Repositories\CompanyRepository;
use Illuminate\Http\Request;
use Mockery\Exception;
use Product\Models\Options;
use Product\Models\OptionValue;
use Product\Models\Sku;
use Product\Models\Variants;
use Product\Repositories\ProductRepository;

class ApiProductController extends BaseController
{
    protected $model;
    protected $com;
    public function __construct(Request $request, ProductRepository $productRepository, CompanyRepository $companyRepository)
    {
        $this->model = $productRepository;
        $this->com = $companyRepository;
    }

    public function getCompany(Request $request){
        $return_arr = array();
        $keyword = $request->get('keyword');
        $listCompany = $this->com->orderBy('created_at','desc')
            ->where('name','LIKE','%'.$keyword.'%')
            ->where('lang_code',session('lang'))->limit(3)->get(['id','name']);
        foreach($listCompany as $key=>$val){
            $return_arr[] = array('id'=>$val->id,'name'=>$val->name);
        }
        return \GuzzleHttp\json_encode($return_arr);
    }

    public function ajaxCreateOption(Request $request){
        $name = $request->get('name');
        $visual = $request->get('visual');
        $product_id = $request->get('product_id');
        $data = [
            'name'=>$name,
            'visual'=>$visual,
            'product_id'=>$product_id
        ];
        $create = Options::create($data);
        return \GuzzleHttp\json_encode($create);
    }

    public function ajaxRemoveOption(Request $request){
        $id = $request->get('remove');
        $option = Options::find($id);
        if($option){
           $option->delete();
            return '200';
        }else{
            return 'error';
        }
    }
    //create option value
    public function ajaxCreateOptionValue(Request $request){
        $name = $request->get('name');
        $label = $request->get('label');
        $option = $request->get('option');
        $product_id = $request->get('product_id');
        $data = [
          'product_id'=>$product_id,
          'option_id'=>$option,
          'value'=>$name,
          'label'=>$label
        ];
        try{
            $create = OptionValue::create($data);
            return \GuzzleHttp\json_encode($create);
        }catch (Exception $e){
            return response()->json($e->getMessage());
        }

    }
    //ajax remove option value
    public function ajaxRemoveOptionValue(Request $request){
        $id = $request->get('id');
        $optionValue = OptionValue::find($id);
        if($optionValue){
            $optionValue->delete();
            return '200';
        }else{
            return 'error';
        }
    }

    public function postVariant(Request $request){
        $data = array();
        $product_id = $request->get('product_id');
        $option_id = $request->get('option_id');
        $option_value = $request->get('option_value');
        $sku_price = $request->get('sku_price');
        $sku_variant = $request->get('sku_variant');
        $sku_barcode = $request->get('sku_barcode');
        try{

            $data_sku = [
                'product_id'=>$product_id,
                'price'=>$sku_price,
                'name'=>$sku_variant,
                'barcode'=>$sku_barcode
            ];
            $createSku = Sku::create($data_sku);

            foreach($option_id as $key=>$val){
                $data = [
                    'product_id'=>$createSku->product_id,
                    'sku_id'=>$createSku->id,
                    'option_id'=>$val['value'],
                    'option_value_id'=>$option_value[$key]['value'],
                ];
                try{
                    Variants::create($data);
                }catch (Exception $e){
                    return $e->getMessage();
                }

            }
            return response()->json($createSku);
        }catch (Exception $exception){
          return $exception->getMessage();
        }

    }

    //edit sku
    public function getEditVariant(Request $request){
        $sku = $request->get('sku');
        $itemSku = Sku::find($sku);
        $itemSku->price = $request->get('sku_price');
        $itemSku->name = $request->get('sku_variant');
        $itemSku->barcode = $request->get('sku_barcode');
        $itemSku->save();

        return response()->json($itemSku);
    }
    //remove sku
    public function getRemoveSku(Request $request){
        $id = $request->get('id');
        $sku = Sku::find($id);
        $variant = Variants::where('sku_id',$id);
        $variant->delete();
        if($sku){
            $sku->delete();
            return '200';
        }else{
            return 'error';
        }
    }

}
