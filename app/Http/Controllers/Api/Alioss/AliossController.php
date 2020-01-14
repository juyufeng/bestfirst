<?php

namespace App\Http\Controllers\Api\Alioss;

use App\Filelist;
use OSS\OssClient;
use OSS\Core\OssException;
use League\Flysystem\Filesystem;
use Iidestiny\Flysystem\Oss\OssAdapter;
use Iidestiny\Flysystem\Oss\Plugins\FileUrl;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Flysystem\Exception;
use Mockery\Matcher\Closure;
use App\Http\Requests\Alioss\ObjfileCreate;
use App\Http\Requests\Alioss\FileDownload;

//阿里云OSS 测试文件
//阿里云OSS 测试文件
class AliossController extends Controller
{
    private $accessKeyId;
    private $accessKeySecret;
    private $endpoint;
    private $ossClient;

    //构造函数
    public function __construct()
    {
       $this->accessKeyId = config('filesystems.disks.oss.access_key');
       $this->accessKeySecret = config()->get('filesystems.disks.oss.secret_key');
       $this->endpoint = config()->get('filesystems.disks.oss.endpoint');
       $this->ossClient = new OssClient($this->accessKeyId, $this->accessKeySecret, $this->endpoint);
    }

    public function getAdapter($bucket){
        return new OssAdapter($this->accessKeyId, $this->accessKeySecret, $this->endpoint, $bucket, false);
    }

    public function createOSSBucket(Request $request){
        $bucket=$request->bucket;
        try {
            $this->ossClient->createBucket($bucket);
            return $this->appSuccess('alioss.createOSSBucket',$this->ossClient);
        } catch (OssException $e) {
            return $this->appError('alioss.createOSSBucket',$e->getMessage());
        }
    }

    //he difference between the request time and the current time is too large.
    public function listOSSBucket(Request $request){
        try {
            return $this->appSuccess('alioss.listOSSBucket',$this->ossClient->listBuckets());
        } catch (OssException $e) {
            return $this->appError('alioss.listOSSBucket',$e->getMessage());
        }
    }

    public function createStringFile(Request $request)
    {
        $bucket=$request->bucket;
        // object 表示您在下载文件时需要指定的文件名称，如abc/efg/123.jpg。
        $object = request()->object;
        $content = request()->content;
        try {
            $this->ossClient->putObject($bucket, $object, $content);
            return $this->appSuccessNoData('alioss.createStringFile');
        } catch (OssException $e) {
            return $this->appError('alioss.createStringFile',$e->getMessage());
        }
    }

    public function createObjFile(ObjfileCreate $request, $callback){
        $bucket=$request->bucket;
        // object 表示您在下载文件时需要指定的文件名称，如abc/efg/123.jpg。
        $object = request()->object;
        // <yourLocalFile>由本地文件路径加文件名包括后缀组成，例如/users/local/myfile.txt
        $localfile = request()->localfile;
        try{
            $this->ossClient->uploadFile($bucket, $object, $localfile);
            if($callback){
               return  $callback($request);
            }
            return $this->appSuccessNoData('alioss.createObjFile');
        }catch(OssException $e) {
            return $this->appError('alioss.createObjFile',$e->getMessage());
        }
    }

    public function downloadFile(FileDownload $request){

       try{
           $timeout = 3600;
           if($request->has('timeout')){
               $timeout = $request->timeout?$request->timeout:3600;
           }
           $bucket = "foxymoon";
           if($request->has('bucket')){
               $bucket = $request->bucket?$request->bucket:"foxymoon";
           }

            // 使用签名 url 进行临时授权访问
           $signedUrl =$this->getAdapter($bucket)->signUrl($request->object,$timeout);
           $filelist =  Filelist::where("object", $request->object)->first();
           $filelist->download_url = $signedUrl;

            return $this->appSuccess('alioss.downloadFile',$filelist);
        }catch(OssException $e) {
            return $this->appError('alioss.downloadFile',$e->getMessage());
        }
    }

    public function downFile($timeout,$bucket,$object){
            // 使用签名 url 进行临时授权访问
            $signedUrl =$this->getAdapter($bucket)->signUrl($object,$timeout);
            $filelist =  Filelist::where("object", $object)->first();
            $filelist->download_url = $this->isContainHttp($signedUrl)?$signedUrl:"http://".$signedUrl;
            return $filelist;
    }


}

