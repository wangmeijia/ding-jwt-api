<?php


// 测试路由
//$api = app('Dingo\Api\Routing\Router');
$this->api->post('register', 'AuthController@register')->name('Tinyapi.register');;
$this->api->post('login', 'AuthController@login')->name('login');;
$this->api->post('logout', 'AuthController@logout')->name('Tinyapi.logout');
$this->api->post('refresh', 'AuthController@refresh')->name('Tinyapi.refresh');
$this->api->get('me', 'AuthController@me')->name('Tinyapi.me');
$this->api->get('/', ['uses'=>'AuthController@index','middleware'=>'auth:apijwt']);


//单数据表接⼝口规则(GET)
///theapi/数据表名/参数1=值&参数2=值&参数n=值
/// http://127.0.0.1:8001/theapi/users/name=meijia&email=12
///
///
/// Route::get('/{param1}/{param2}', 'TestController@index');
 //echo config('router.0.table');
//dd(config('userApi.router.0.fields'));
$this->api->get("/users/{string}", 'QueryController@getOne')->name('getOne1');

//$this->api->get(config('userApi.router.0.table').'/'.config('userApi.router.0.fields'), 'QueryController@getOne')->name('getOne');
//$this->api->get(config('userApi.router.1.table').'/'.config('userApi.router.1.fields'), 'QueryController@getOne')->name('getOne');
//$this->api->get("/users/name=meijia&email=12", 'QueryController@getOne')->name('getOne1');
$this->api->get("/migrations/", 'QueryController@getOne')->name('getOne2');
$this->api->post('/post/users', 'QueryController@postDatas')->name('postdatas');
$this->api->put('/put/users/{string}', 'QueryController@putDatas')->name('putDatas');
$this->api->delete('/delete/users/{string}', 'QueryController@deleteDatas')->name('putDatas');


//通⽤用接⼝口规则
#config('userApi.selectSql')

$this->api->any('/selectSql', 'QueryAllController@selectSql')->name('putDatas');
$this->api->any('/updateSql', 'QueryAllController@updateSql')->name('putDatas');
$this->api->any('/insertSql', 'QueryAllController@insertSql')->name('putDatas');
$this->api->any('/deleteSql', 'QueryAllController@deleteSql')->name('putDatas');


//Route::post('login', 'AuthController@login');
//Route::post('logout', 'AuthController@logout');
//Route::post('refresh', 'AuthController@refresh');
//Route::post('me', 'AuthController@me');

   // Route::get('/index', 'TinyapiController@index');
   // Route::post('/store', 'TinyapiController@store')->name('Tinyapi.store');
