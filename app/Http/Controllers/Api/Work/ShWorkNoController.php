<?php

namespace App\Http\Controllers\Api\Work;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ShWorkNo;
use App\Http\Requests\Work\ShWorkInsert;
use App\Http\Requests\Work\ShWorkFindOne;
use App\Http\Requests\Work\ShWorkUpdate;
use App\Http\Requests\Work\ShWorkDelete;
use App\Http\Requests\Work\ShWorkList;

class ShWorkNoController extends Controller
{
    public function insert(ShWorkInsert $request){
        try{
            //记录 user_id
            return $this->appSuccess('work.shworkno.insert',$request->user()->shworknos()->create($request->all()));
        }catch(Expectation $error){
            $this->appError('work.shworkno.insert', $error);
        }
    }

    public function findOne(ShWorkFindOne $request){
        try{
            $model = new ShWorkNo();
            $oneObj = $model->findOne($request);
            return $this->appSuccess('work.shworkno.findOne', $oneObj);
        }catch(Expectation $error){
            return $this->appError('work.shworkno.findOne', $error);
        }
    }

    public function update(ShWorkUpdate $request){
        try{
            //fineOne
            $model = new ShWorkNo();
            $oneObj = $model->findOne($request);
            //update
            if($oneObj->update($request->all())){
                return $this->appSuccess('work.shworkno.update',$oneObj);
            }else{
                $this->appError('work.shworkno.update', '更新失败');
            }
        }catch(Expectation $error){
            $this->appError('work.shworkno.update', $error);
        }
    }

    public function delete(ShWorkDelete $request){
        try{
            //fineOne
            $model = new ShWorkNo();
            $oneObj = $model->findOne($request);
            //delete
            if($oneObj->delete()){
                return  $this->appSuccess('alioss.shworkno.delete');
            }else{
                return  $this->appError('alioss.shworkno.delete', '逻辑正常,删除失败:1.未找到这条数据 2.排查是否有数据库资源竞争!');
            }
        }catch(Expectation $error){
            $this->appError('work.shworkno.delete', $error);
        }
    }

    public function list(ShWorkList $request){
        $pre_entry_id = request('pre_entry_id');
        $bill_no = request('bill_no');
        $Container_number = request('Container_number');

        $per_page = request('per_page');
        $istoSql = request('istoSql');

        try{
            $model = new ShWorkNo();

            if($request->has('pre_entry_id')){
                $model = $model->where('pre_entry_id','like', "%{$pre_entry_id}%");
            }
            if($request->has('bill_no')){
                $model = $model->where('bill_no','like', "%{$bill_no}%");
            }
            if($request->has('Container_number')){
                $model = $model->where('Container_number','like', "%{$Container_number}%");
            }

            if($istoSql){
                return $this->appSuccess('alioss.shworkno.list',$model->toSql());
            }
            $model = $model->paginate($per_page);
            return $this->appSuccess('alioss.shworkno.list',$model);
        }catch(Expectation $error){
            $this->appError('alioss.shworkno.list', $error);
        }
    }

}
