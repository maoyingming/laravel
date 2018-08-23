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

Route::get('/', function () {
    return view('welcome');
});

/*Route::get('user/{id}', function ($id) {
    return 'User '.$id;
});*/

//Route::get('/index', 'Admin\IndexController@index');

Route::get('user/profile', function () {
    //
    return 2;
})->name('profile');

/*Route::group(['middleware' => 'check.login'], function(){
    Route::get('admin/index', 'Admin\IndexController@index');
});*/

/*Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function(){
    Route::get('/index', 'Admin\IndexController@index');
});*/
//Route::group(['namespace' => 'admin', 'middleware' => ['check.login']], function () {
//    Route::get('index', function(){
//        echo 'AdminController@index';exit;
//    }); //后台首页
//
//});
Route::get('/login', function () {
    return view('admin.login');
});

Route::group(['namespace' => 'admin'], function () {
    Route::post('/loginSubmit', 'LoginController@loginSubmit'); //登陆提交处理
});


/*Route::group(['namespace' => 'admin', 'middleware' => ['check.login']], function () {
    Route::get('index', 'IndexController@index'); //后台首页

});*/