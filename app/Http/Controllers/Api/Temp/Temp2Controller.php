<?php

namespace App\Http\Controllers\Api\Temp;

use App\AddrInfo;
use App\Temp002;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Temp2Controller extends Controller
{
    public function list(Request $request){
        $tag1 = request('tag1');
        $per_page = request('per_page');

        try{
            $model = new Temp002();

            if($request->has('tag1')){
                $model = $model->where('tag1', $tag1);
            }
            $model = $model->paginate($per_page);

            return $this->appSuccess('temp.temp002.list',$model);
        }catch(Expectation $error){
            $this->appError('temp.temp002.list', $error);
        }
    }
    public function  getMulu(Request $request){
        $data = Temp002::get('tag1')->Max('tag1');
        return $data + 1;
    }
    public function deleteByMulu(Request $request){
        $this->validate($request, [
            'tag1' => 'required|exists:temp002s,tag1'
        ]);
        $isFirst = Temp002::where('tag1', $request->tag1)->first();
        $isFirst->delete();
        return "删除成功";
    }
    public function  getX1(Request $request){
        $data = Temp002::where('tag2', $request->tag2)
            ->where('tag10', $request->tag10)
            ->get()
            ->Max('tag4');
        return $data + 1;
    }
    public function  getX2(Request $request){
        return '001';
    }
    public  function  getAirCode(Request $request){
        $air = $request->air;
        $data =  AddrInfo::where('addr_name', $air)
            ->get();
        if($data->count() == 0)
        {
            $data =  AddrInfo::where('addr_name', 'like' ,'%'.$air.'%')
                ->get();
        }
        if($data->count()>0){
            if($data->count() == 1){
                $one = $data[0];
                $p_code1 = $one->p_code;
                $pData1 = AddrInfo::where('addr_code', $p_code1)->first();
                $data[0]->upAir = $pData1->addr_name;
            }else{
                $one = $data[0];
                $p_code1 = $one->p_code;
                $pData1 = AddrInfo::where('addr_code', $p_code1)->first();
                $data[0]->upAir = $pData1->addr_name;

                $two = $data[1];
                $p_code2 = $two->p_code;
                $pData2 = AddrInfo::where('addr_code', $p_code2)->first();
                $data[1]->upAir = $pData2->addr_name;
            }
        }
        return  $data;
    }

    public function  getAll(Request $request){
        $model = new Temp002();
       return  $model->ryfzAll();
    }

    public function insertOrUpdateAndReturnAll(Request $request){
        try{
            //fineOne
            $model = new Temp002();
            if($request->searchTag == "修改或保存")
            {
                $oneObj = $model->findOne($request)?$model->findOne($request): new Temp002();

                $oneObj->tag1 = trim($request->tag1);
                $oneObj->tag2 = trim($request->tag2);
                $oneObj->tag3 = trim($request->tag3);
                $oneObj->tag4 = trim($request->tag4);
                $oneObj->tag5 = trim($request->tag5);
                $oneObj->tag6 = trim($request->tag6);
                $oneObj->tag7 = trim($request->tag7);
                $oneObj->tag8 = trim($request->tag8);
                $oneObj->tag9 = trim($request->tag9);
                $oneObj->tag9 = trim($request->tag9);
                $oneObj->tag10 = trim($request->tag10);

                $oneObj->save();
                return  $model->ryfzAll();
            }
            if($request->searchTag == "首次加载或数据刷新"){
                return  $model->ryfzAll();
            }
            if($request->searchTag == "导出Excel"){
                $model = new Temp002();
                $model = $model->where('tag1', '<>' ,'');
                $model->orderBy('tag1','desc');
                return $model->get();
            }
            if($request->searchTag == "导出当日Excel"){
                $model = new Temp002();
                $model = $model->where('tag1', '<>' ,'');
                $model->where('created_at','like', Carbon::now()->format('Y-m-d').'%');
                $model->orderBy('tag1','desc');
                return $model->get();
            }
            if($request->searchTag == "通用查询"){
                $tag8 = $request->tag8;
                $tag6 = $request->tag6;
                $tag1 = $request->tag1;
                if($tag8){
                    $obj = Temp002::where('tag8', 'like' , '%'.$request->tag8.'%')
                        ->limit(150)
                        ->get();
                    return $obj;
                }
                if($tag6){
                    $obj = Temp002::where('tag6', 'like' , '%'.$request->tag6.'%')
                        ->limit(150)
                        ->get();
                    return $obj;
                }
                if($tag1){
                    $obj = Temp002::where('tag1', 'like' , '%'.$request->tag1.'%')
                        ->limit(150)
                        ->get();
                    return $obj;
                }
            }
        }catch(Expectation $error){
            $this->appError('temp.temp002.insertOrUpdateAndReturnAll', $error);
        }
    }



}
