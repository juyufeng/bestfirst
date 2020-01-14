<?php

namespace App\Http\Controllers\Api\Qiniu;

use App\Filelist;
use App\Http\Requests\Alioss\FilelistFindOne;
use App\User;
use Illuminate\Http\Request;
use Log;
use League\Flysystem\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class QFilelistController extends QiniuController
{
    public function insert(Request $request){
        try{
//            $data = file_get_contents('php://input');
            $data = $request->getContent();
            Log::info($data);
            $de_data = json_decode($data);
            $de_data->object = $de_data->key;
            $remove_null_data = $this->removeNullValue($de_data);

            $valid_collect = collect([]);
            $tables = Schema::getConnection()->getDoctrineSchemaManager()->listTableColumns("filelists");
            foreach($tables as $key=>$value)
            {
                if(Str::contains($key, "`"))
                {
                    $key = str_replace("`","",$key);
                }
                if(collect(['id'])->contains($key))
                {
                    //过滤不处理
                }else{
                    $valid_collect->push($key);
                }
            }

            $key =  Filelist::where('object',$remove_null_data->key)->first();

            if($key){
                $key->delete();
            }
            $filelist = new Filelist();
            foreach ($remove_null_data as $k=>$v){
                    if($valid_collect->contains($k)){
                        $filelist->$k =urldecode($v);
                    }
            }
            $filelist->save();

            return $this->appSuccess('notoken.qiniu.filelist.insert', $filelist);
        }catch(Expectation $error){
            return $this->appError('notoken.qiniu.filelist.insert', $error);
        }
    }

    public function findOne(FilelistFindOne $request)
    {
        try{
            $filelist = new Filelist();
            $oneObj = $filelist->findOne($request);
            return $this->appSuccess('qiniu.filelist.findOne', $oneObj);
        }catch(Expectation $error){
            return $this->appError('qiniu.filelist.findOne', $error);
        }
    }

    public function delete(FilelistDelete $request){
        try{
            //fineOne
            $filelist = new Filelist();
            $oneObj = $filelist->findOne($request);
            //delete
            if($oneObj->delete()){
                return  $this->appSuccess('qiniu.filelist.delete');
            }else{
               return  $this->appError('qiniu.filelist.delete', '逻辑正常,删除失败:1.未找到这条数据 2.排查是否有数据库资源竞争!');
            }
        }catch(Expectation $error){
            $this->appError('qiniu.filelist.delete', $error);
        }
    }

    public function list(FilelistList $request){
        $pre_entry_id = request('pre_entry_id');
        $bill_no = request('bill_no');
        $container_number = request('container_number');
        $object = request('object');
        $bucket = request('bucket');

        $per_page = request('per_page');
        $istoSql = request('istoSql');

        try{
            $filelist = new Filelist();

            if($request->has('pre_entry_id')){
                $filelist = $filelist->where('pre_entry_id','like', "%{$pre_entry_id}%");
            }
            if($request->has('bill_no')){
                $filelist = $filelist->where('bill_no','like', "%{$bill_no}%");
            }
            if($request->has('container_number')){
                $filelist = $filelist->where('container_number','like', "%{$container_number}%");
            }
            if($request->has('object')){
                $filelist = $filelist->where('object','like', "%{$object}%")
                ->where('bucket','like',"%{$bucket}%");
            }
            if($istoSql){
                return $this->appSuccess('qiniu.filelist.list',$filelist->toSql());
            }
            $filelist = $filelist->paginate($per_page);
            return $this->appSuccess('qiniu.filelist.list',$filelist);
        }catch(Expectation $error){
            $this->appError('qiniu.filelist.list', $error);
        }

    }
}
