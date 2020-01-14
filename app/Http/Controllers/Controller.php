<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Mockery\Expectation;
use Illuminate\Http\Resources\Json\JsonResource;

class appMessage
{
    public  $code;
    public  $data;
    public  $message;
}

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function appSuccess($message,$data=''){
        return response()->json(
            [
                'data' => $data?$data:'',
                'code'=>200,
                'message'=>'success:'.$message
            ]
        );
    }

    public function appSuccessNoData($message){
        return response()->json(
            [
                'code'=>200,
                'message'=>'success:'.$message
            ]
        );
    }

    public function appError($message,$human_error){
        Log::error($message.':'.$human_error);
        return response()->json(
            [
                'code'=>9999,
                'message'=> 'error'.$message.'=>'.$human_error
            ]
        );
    }

    public function replaceNullValueEmpty($request)
    {
        //递归方式把数组或字符串 null转换为空''字符串
        $callback = function ($arr) use (&$callback) {
            if($arr !== null){
                if(is_array($arr)){
                    if(!empty($arr)){
                        foreach($arr as $key => $value){
                            if($value === null){
                                $arr[$key] = '';
                            }else{
                                $arr[$key] = $callback($value);      //递归再去执行
                            }
                        }
                    }
                }else{
                    if($arr === null){ $arr = ''; }         //注意三个等号
                }
            }else{
                $arr = '';
            }
            return $arr;
        };

        $newData = $callback($request);
        return $newData;
    }

        public function  removeNullValue($request){
            foreach($request as $key => $value){
                if($value === null || trim($value) == ''){
                    unset($request->$key);
                }
            }
            return $request;
        }

        public function isContainHttp($url){
            $preg = "/^http(s)?:\\/\\/.+/";
            if(preg_match($preg,$url))
            {
                return true;
            }
            else
            {
                return false;
            }
        }




}


