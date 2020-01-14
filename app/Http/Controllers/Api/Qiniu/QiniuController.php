<?php

namespace App\Http\Controllers\Api\Qiniu;

use App\Filelist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use League\Flysystem\Adapter\AbstractAdapter;
use League\Flysystem\Config;
use Qiniu\Auth;
use Auth as LaravelAuth;
use Qiniu\Storage\BucketManager;
use Qiniu\Storage\UploadManager;
use Mockery\Expectation;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Carbon\Carbon;


class QiniuController extends Controller
{
    protected $uploadManager;
    protected $bucketManager;
    private $accessKey;
    private $accessSecret;
    private $bucketName;
    public $auth;
    private $policy;

    //构造函数
    public function __construct()
    {
        $this->uploadManager = new UploadManager();
        $this->accessKey = config('filesystems.disks.qiniu.key');
        $this->accessSecret = config('filesystems.disks.qiniu.secret');
        $this->bucketName = config('filesystems.disks.qiniu.bucket');
        $this->auth = new Auth($this->accessKey, $this->accessSecret);
        $this->bucketManager = new BucketManager($this->auth);
    }

    public function configPolicy (Request $request)
    {
        $tables = Schema::getConnection()->getDoctrineSchemaManager()->listTableColumns($request->table_name);
        foreach($tables as $key=>$value)
        {
            if(Str::contains($key, "`"))
            {
                $key = str_replace("`","",$key);
            }
            if(collect(['id'])->contains($key))
            {
                //过滤不处理
            }
            elseif(collect(['bucket','fsize','fname'])->contains($key))
            {
                //系统字符串
                $obj[$key]= '$('.$key.')';
            }
            else{
                //自定义字符串
                $obj[$key]= '$(x:'.$key.')';
            }
            //必须要有的字段
            $obj['key']='$(key)';
        }

        $this->policy = [
            'scope' =>$this->bucketName.':'.$request->key,
            'deadline'=>Carbon::now()->addSeconds(3600)->timestamp,
            'callbackUrl' => config('filesystems.disks.qiniu.callbackurl'),
            'callbackBody' => json_encode($obj),
            'callbackHost' => config('filesystems.disks.qiniu.host'),
//            'callbackBodyType' => 'application/x-www-form-urlencoded',
            'callbackBodyType' => 'application/x-www-form-urlencoded',
            'insertOnly' => 0,
            'fileType' => 1,
            'detectMime'=>1
        ];
        return $this->policy;
    }

    public function getQiniuUploadToken(Request $request)
    {
        try{
            if(LaravelAuth::check()){
                $user_id = LaravelAuth::user()->id;
            }else{
                $user_id = 9999;
            }
            $token = $this->auth->uploadToken($this->bucketName, $request->key, 7200, $this->configPolicy($request), true);
            return $this->appSuccess('qiniu.token.upload',compact('token','user_id'));
        }catch(Expectation $err){
            return $this->appError('qiniu.token.upload',$err);
        }
    }

    public function getQiniuDownloadUrl(Request $request){
        try{
            // 私有空间中的外链 http://<domain>/<file_key>
            $baseUrl = config('filesystems.disks.qiniu.download_domain').'/'.$request->object;
            $signedUrl = $this->auth->privateDownloadUrl($baseUrl);
            $filelist =  Filelist::where("object", $request->object)->first();
            $filelist->download_url = $signedUrl;
            return $this->appSuccess('qiniu.file.download.url',$filelist);
        }catch(Expectation $err){
            return $this->appError('qiniu.file.download.url', $err);
        }
    }

    public function downFile($timeout,$bucket,$object){
            // 私有空间中的外链 http://<domain>/<file_key>
            $baseUrl = config('filesystems.disks.qiniu.download_domain').'/'.$object;
            $signedUrl = $this->auth->privateDownloadUrl($baseUrl);
            $filelist =  Filelist::where("object", $object)->first();
            $filelist->download_url = $this->isContainHttp($signedUrl)?$signedUrl:"http://".$signedUrl;
            return $filelist;
    }


}
