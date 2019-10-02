<h1 align="center"> api </h1>

<p align="center"> tiniy api for login & register & other.</p>


## Installing

```shell
$ composer require tiniy/api -vvv

#php artisan vendor:publish --tag=config 发步配置文件


php artisan route:cache -v
php artisan api:routes 查看当前可用的api 路由（dinggo route）

在route/api.php里需要加 自定义api路由
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function (  $api) {

    $api->group(['namespace'=>'Tiniy\Api\Http\Controllers'],function ($api){

       // $this->loadRoutesFrom(__DIR__.'/../Http/routes.php');

       // $api->get('/register', 'TinyapiController@register');
    });

});
```

## Usage

TODO

## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/tiniy/api/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/tiniy/api/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT

