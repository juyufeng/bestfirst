<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3", "rackspace"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
        ],

        'oss' => [
            'driver' => 'oss',
            'root' => '',
            'access_key' => env('ALIYUN_ACCESSKEYID'),
            'secret_key' => env('ALIYUN_ACCESSKEYSECRET'),
            'endpoint'   => env('ALIYUN_ENDPOINT'), // 使用 ssl 这里设置如: https://oss-cn-beijing.aliyuncs.com
            'bucket'     => env('ALIYUN_BUCKET'),
            'isCName'    => false, // 如果 isCname 为 false，endpoint 应配置 oss 提供的域名如：`oss-cn-beijing.aliyuncs.com`，否则为自定义域名，，cname 或 cdn 请自行到阿里 oss 后台配置并绑定 bucket
            'ssl' => false,
             //'endpoint_internal' => '<internal endpoint [OSS内网节点] 如：oss-cn-shenzhen-internal.aliyuncs.com>',
            //'cdnDomain' => '<CDN domain, cdn域名>',
        ],

        'qiniu' => [
            'driver' => 'qiniu',
            'key' => env('QINIU_ACCESS_KEY'),
            'secret' => env('QINIU_SECRET_KEY'),
            'region' => env('QINIU_DEFAULT_REGION'),
            'bucket' => env('QINIU_BUCKET'),
            'callbackurl' => env('QINIU_CALLBACKURL'),
            'host'=>env('QINIU_HOST'),
            'download_domain'=>env('QINIU_DOWNLOAD_DOMAIN')
        ],

    ],

];