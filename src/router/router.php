<?php


// 测试路由
//$api = app('Dingo\Api\Routing\Router');
//dd(config());
$this->api->get('/index', 'TinyapiController@index');
$this->api->post('/store', 'TinyapiController@store')->name('Tinyapi.store');
//
//Route::post('login', 'AuthController@login');
//Route::post('logout', 'AuthController@logout');
//Route::post('refresh', 'AuthController@refresh');
//Route::post('me', 'AuthController@me');

   // Route::get('/index', 'TinyapiController@index');
   // Route::post('/store', 'TinyapiController@store')->name('Tinyapi.store');
