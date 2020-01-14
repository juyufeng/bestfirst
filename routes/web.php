<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

# routes/web.php
Route::get('/passport', function () {
    return view('auth.passport');
});

Route::group(['prefix' => 'admin'], function () {
    // https://docs.laravelvoyager.com/getting-started/installation
    Voyager::routes();
});
//viviport首页
Route::namespace('Viviport')->group(function(){

    Route::get('/products', 'IndexController@index')->name('viviport.index');
    Route::get('/product/{id}', 'IndexController@detail');
    Route::get('/product/download/{id}', 'IndexController@download');

});

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/welcome', function () {
    return view('welcome');
});
