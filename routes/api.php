<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::namespace('Auth')->group(function () {
    Route::post('login', 'AuthController@login')->name('login');
    Route::post('register', 'AuthController@register')->name('register');
});
Route::middleware(['auth:api','replace.null'])->group(function () {
    //阿里OSS
    Route::namespace('Alioss')->group(function ()
    {
        Route::prefix('alioss')->group(function () {

            Route::get('/', 'AliossController@listOSSBucket')->name('alioss.listOSSBucket');
            Route::post('/bucket/create', 'AliossController@createOSSBucket')->name('alioss.bucket.create');
            Route::post('/stringfile/create', 'AliossController@createStringFile')->name('alioss.stringfile.create');
            Route::post('/objfile/create', 'AliossController@createObjFile')->name('alioss.objfile.create');
            Route::post('/file/download', 'AliossController@downloadFile')->name('alioss.file.download');

            Route::prefix('filelist')->group(function () {
                Route::post('/insert', 'FilelistController@insert')->name('alioss.filelist.insert');
                Route::post('/update', 'FilelistController@update')->name('alioss.filelist.update');
                Route::post('/delete', 'FilelistController@delete')->name('alioss.filelist.delete');
                Route::post('/list', 'FilelistController@list')->name('alioss.filelist.list');
                Route::Post('/findOne', 'FilelistController@findOne')->name('alioss.filelist.findOne');
            });
        });
    });
    //七牛OSS
    Route::namespace('Qiniu')->group(function ()
    {
        Route::prefix('qiniu')->group(function () {

            Route::get('/token/upload', 'QiniuController@getQiniuUploadToken')->name('qiniu.token.upload');
            Route::post('/file/download', 'QiniuController@getQiniuDownloadUrl')->name('qiniu.file.download.url');

            Route::prefix('filelist')->group(function () {
                Route::post('/insertOrUpdate', 'QFilelistController@insertOrUpdate')->name('qiniu.filelist.insertOrUpdate');
                Route::post('/delete', 'QFilelistController@delete')->name('qiniu.filelist.delete');
                Route::post('/list', 'QFilelistController@list')->name('qiniu.filelist.list');
                Route::Post('/findOne', 'QFilelistController@findOne')->name('qiniu.filelist.findOne');
            });
        });
    });
    Route::namespace('Temp')->group(function ()
    {
        Route::prefix('temp002')->group(function () {
            Route::post('iua', 'Temp2Controller@insertOrUpdateAndReturnAll');
            Route::post('getAll', 'Temp2Controller@getAll');
            Route::post('getAirCode', 'Temp2Controller@getAirCode');
            Route::post('getMulu', 'Temp2Controller@getMulu');
            Route::post('getX1', 'Temp2Controller@getX1');
            Route::post('getX2', 'Temp2Controller@getX2');
            Route::post('deleteByMulu', 'Temp2Controller@deleteByMulu');
        });
        Route::prefix('temp004')->group(function ()
        {
            Route::post('sendmail', 'Temp5Controller@SendMail');
        });
    });
});
