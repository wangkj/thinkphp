<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;
//get
Route::get('test','api/test/index');
Route::put('test/:id','api/test/update');
Route::delete('test/:id', 'api/test/delete');

//Route::resource('test','api/test');
Route::resource('test/sms','api/test/sms');
Route::get('api/cat','api/cat/read');

//短信验证码
Route::resource('api/sendsms','api/register');

//登陆
Route::post('api/login','api/login/save');