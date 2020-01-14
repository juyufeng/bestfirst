<?php

namespace App\Http\Controllers\Api\Alioss;

use Illuminate\Http\Request;
use Mockery\Expectation;
use App\Filelist;
use App\Http\Requests\Alioss\FilelistFindOne;
use App\Http\Requests\Alioss\FilelistInsert;
use App\Http\Requests\Alioss\FilelistUpdate;
use App\Http\Requests\Alioss\FilelistDelete;
use App\Http\Requests\Alioss\FilelistList;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Schema;

class FilelistController extends AliossController
{

    //注意:上传OSS同名文件会覆盖
    //数据+文件: 如果有文件需要创建和更新, 只有当文件更新成功了, 才可以更新数据;
    public function insert(FilelistInsert $request){
        $callback = function ($request){
            try{
                $filelist =  Filelist::where('object',$request->object)->first();
                if($filelist){
                    $filelist->delete();
                }
                //记录 user_id
                return $this->appSuccess('alioss.filelist.insert',$request->user()->filelists()->create($request->all()));
            }catch(Expectation $error){
                $this->appError('alioss.filelist.insert', $error);
            }
        };
       return $this->createObjFile($request,$callback);
    }

    public function findOne(FilelistFindOne $request)
    {
        try{
            $filelist = new Filelist();
            $oneObj = $filelist->findOne($request);
            return $this->appSuccess('alioss.filelist.findOne', $oneObj);
        }catch(Expectation $error){
            return $this->appError('alioss.filelist.findOne', $error);
        }
    }

    public function update(FilelistUpdate $request){
        //优先以id为主键更新
        $callback = function ($request) {
            try{
                //fineOne
                $filelist = new Filelist();
                $oneObj = $filelist->findOne($request);
                //update
                if($oneObj->update($request->all())){
                    return $this->appSuccess('alioss.filelist.update',$oneObj);
                }else{
                    $this->appError('alioss.filelist.update', '更新失败');
                }
            }catch(Expectation $error){
                $this->appError('alioss.filelist.update', $error);
            }
        };
        if($request->has('object')){
            return $this->createObjFile($request,$callback);
         }else{
            return $callback($request);
         }
    }

    public function delete(FilelistDelete $request){
        try{
            //fineOne
            $filelist = new Filelist();
            $oneObj = $filelist->findOne($request);
            //delete
            if($oneObj->delete()){
               return  $this->appSuccess('alioss.filelist.delete');
            }else{
               return  $this->appError('alioss.filelist.delete', '逻辑正常,删除失败:1.未找到这条数据 2.排查是否有数据库资源竞争!');
            }
        }catch(Expectation $error){
            $this->appError('alioss.filelist.delete', $error);
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
                return $this->appSuccess('alioss.filelist.list',$filelist->toSql());
            }
            $filelist = $filelist->paginate($per_page);
            return $this->appSuccess('alioss.filelist.list',$filelist);
        }catch(Expectation $error){
            $this->appError('alioss.filelist.list', $error);
        }

    }



}



// if($request->has('xmlName'))
//             {
//                 $cellData = collect([]);

//                 $tables = Schema::getConnection()->getDoctrineSchemaManager()->listTableColumns('filelists');
//                 $table_columns = collect([]);
//                 foreach($tables as $key=>$value){
//                     $table_columns->push($key);
//                 }
//                 $cellData->push($table_columns);

//                 foreach($filelist->get() as $key=>$value){
//                     $row = collect([]);
//                     if($value){
//                         foreach($value->toArray() as $key=>$clu){
//                             $row->push($clu);
//                         }
//                         $cellData->push($row);
//                     }
//                 }
// }
