<?php

namespace App\Http\Middleware;

use Closure;

class ReplaceNull
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
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

        $response = $next($request);
        $data = json_decode($response->getContent(), true);
        if(isset($data['data'])){
            $newData = $callback($data['data']);
            $data['data'] = $newData;
            return $response->setContent(json_encode($data));
        }
        return $response;
    }

}
