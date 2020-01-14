<?php

namespace App\Http\Controllers\Web\Viviport;

use App\Filelist;
use App\Http\Controllers\Api\Alioss\AliossController;
use App\Http\Controllers\Api\Qiniu\QiniuController;
use App\Http\Requests\Web\DetailRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function index(Request $request)
    {
        //排序规则

        //
       $filelists = Filelist::paginate(12);

        return view('viviport.index', compact("filelists"));
    }

    public  function  detail(Request $request){
        $id = $request->id;
        $filelist = Filelist::find($id);
        $object = $filelist->object;
        $oss =$filelist->oss;
        //如果有权限
        if($oss==="ali"){
            $ali = new AliossController();
            $filelist = $ali->downFile(3600, "foxymoon", $object);
        }elseif ($oss==="qiniu"){
            $qiniu = new QiniuController();
            $filelist = $qiniu->downFile(3600, "foxymoon", $object);
        }
        return view("viviport.".$id, compact('filelist'));
    }

    public function download(Request $request){
        $id = $request->id;
        $filelist = Filelist::find($id);
        $object = $filelist->object;
        $oss =$filelist->oss;
        //如果有权限
        if($oss==="ali"){
            $ali = new AliossController();
            $filelist = $ali->downFile(3600, "foxymoon", $object);
        }elseif ($oss==="qiniu"){
            $qiniu = new QiniuController();
            $filelist = $qiniu->downFile(3600, "foxymoon", $object);
        }
        return $filelist->download_url;
    }





}
