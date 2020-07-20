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
use think\facade\Route;
// 下载页
Route::get('index','@index/index/index')->name('index');
// 主页
Route::get('download','@index/index/download')->name('download');
// ajax分页
Route::get('ajax','@index/index/ajax')->name('ajax');
// 登录页
Route::get('login','@index/login/login')->name('login');
Route::post('login','@index/login/loginSave')->name('login');
// 退出
Route::get('logout','@index/login/logout')->name('logout');
// 搜索
Route::get('search','@index/index/search')->name('index/index/search');



/****************************后台****************************** */

// 注册中间件

    Route::group(['middleware'=>['CheckLogin']],function(){
        // 首页
        Route::get('admin','@admin/index/index')->name('admin/index/index');
        // ajax
        Route::get('adminAjax','@admin/index/adminAjax')->name('admin/index/adminAjax');
        // 资源路由
        Route::resource('soft','admin/soft');
    });

