<?php
namespace Tiniy\Api\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Arr;

/**
 * 这是单元测试组件的服务提供者
 *
 *
 * 组件传统方式的引用的话 就是 composer require xxxxxx组件
 * 然后只要网咯ok就可以从GitHub上下载下来
 */
class TinyapiServiceProvider extends ServiceProvider
{


    // 组件需要注入的中间件
    protected $routeMiddleware = [
        'jwt.auth'    => \Tymon\JWTauth\Middleware\GetUserFromToken::class,
        'jwt.refresh' =>\Tymon\JWTauth\Middleware\RefreshToken::class,

    ];
    var $api = '';
    protected $middlewareGroups = [];


    public function register()
    {


        //dd();


        // 让laravel加载组件的配置文件

       // echo __DIR__ . '/../../config/tinyapi.php';

        $this->mergeConfigFrom(
            __DIR__ . '/../../config/tinyapi.php', 'tinyapi'
        );
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/userApi.php', 'userApi'
        );


        // php artisan vendor:publish --provider="Tiniy\Api\Providers\TinyapiServiceProvider"
        // php artisan vendor:publish --tag=config
        $this->registerPublishing();

        // 注册组件路由
        $this->registerRoutes();
        // 怎么根据配置文件去加载auth信息
        $this->registerRouteMiddleware();
        //设置
       // $this->registerClassAliases();


    }
    // 扩展
    // 自己写一个http/Kernel 继承与 App\Http\Kernel
    // 修改laravel对于 Illuminate\Contracts\Http\Kernel::class 绑定的对象

    public function registerPublishing()
    {
        // 判断是否在命令行中运行
        if ($this->app->runningInConsole()) {
            //                  [当前组件的配置文件路径 =》 这个配置复制那个目录] , 文件标识
            // 1. 不填就是默认的地址 config_path 的路径 发布配置文件名不会改变
            // 2. 不带后缀就是一个文件夹
            // 3. 如果是一个后缀就是一个文件
            //$this->publishes([__DIR__.'/../../Config' => config_path('tinyapi.php')],'config');
            $this->publishes(
                [
                    __DIR__ . '/../../config/tinyapi.php' => config_path( 'tinyapi.php' ),
                __DIR__ . '/../../config/api.php' => config_path( 'api.php' ),
                __DIR__ . '/../../config/userApi.php' => config_path( 'userApi.php' )
                ], 'config'
            );


        }
    }


    public function boot()
    {

        $this->loadSelfConfig();

        //
    }


    private function registerRoutes()
    {

        $this->api = app('Dingo\Api\Routing\Router');
        $this->api->version('v1', function (  ) {

        $this->api->group(['namespace'=>'Tiniy\Api\Http\Controllers'],function (){

            $this->loadRoutesFrom(__DIR__ . '/../router/router.php');



        });

            $this->api->group(['namespace'=>'Tiniy\Api\Http\API\V1'],function (){

                $this->loadRoutesFrom(__DIR__ . '/../router/api.php');



            });

        });

//        Route::group($this->routeConfiguration(), function () {
//
//        });

    }



    // 把这个组件的auth信息合并到config的auth
    protected function loadSelfConfig()
    {
        // Arr 基础操方法封装
        // 这个数组合并之后，一定要再此保持laravel项目中
       // config(Arr::dot(config('tinyapi.api', []), 'api.'));
        config(Arr::dot(config('tinyapi.auth', []), 'auth.'));
        //dd(config());

        // config(Arr::dot(config('wap.member.auth', []), 'auth.'));
    }


    private function routeConfiguration()
    {

        return [
            // 定义访问路由的域名
            // 'domain' => config('telescope.domain', null),
            // 是定义路由的命名空间
            'namespace' => 'Tiniy\Api\Http\Controllers',
            // 这是前缀
            'prefix' =>config('api.prefix', env('API_PREFIX')),
            // 这是中间件
            //'middleware' => 'web',
        ];
    }

    protected function registerRouteMiddleware()
    {
        foreach ($this->middlewareGroups as $key => $middleware) {
            $this->app['router']->middlewareGroup($key, $middleware);
        }

        foreach ($this->routeMiddleware as $key => $middleware) {
            $this->app['router']->aliasMiddleware($key, $middleware);
        }
    }



    /**
     * Register the class aliases.
     *
     * @return void
     */
    protected function registerClassAliases()
    {
//        $serviceAliases = [
//            \Dingo\Api\Http\Request::class => \Dingo\Api\Contract\Http\Request::class,
//            'api.dispatcher' => \Dingo\Api\Dispatcher::class,
//            'api.http.validator' => \Dingo\Api\Http\RequestValidator::class,
//            'api.http.response' => \Dingo\Api\Http\Response\Factory::class,
//            'api.router' => \Dingo\Api\Routing\Router::class,
//            'api.router.adapter' => \Dingo\Api\Contract\Routing\Adapter::class,
//            'api.auth' => \Dingo\Api\Auth\Auth::class,
//            'api.limiting' => \Dingo\Api\Http\RateLimit\Handler::class,
//            'api.transformer' => \Dingo\Api\Transformer\Factory::class,
//            'api.url' => \Dingo\Api\Routing\UrlGenerator::class,
//            'api.exception' => [\Dingo\Api\Exception\Handler::class, \Dingo\Api\Contract\Debug\ExceptionHandler::class],
//        ];
//
//        foreach ($serviceAliases as $key => $aliases) {
//            foreach ((array) $aliases as $alias) {
//                $this->app->alias($key, $alias);
//            }
//        }
    }

}
