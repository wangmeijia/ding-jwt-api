<?php
return [

    'auth' => [
        // 事先的动作,为了以后着想
        //'controller' => ShineYork\LaravelShop\Wap\Member\Http\Controllers\AuthorizationsController::class,
        // 当前使用的守卫,只是定义
        'guard' => 'apijwt',

        // 定义的是守卫组
        'guards' => [

            'apijwt'=>[
                'driver'=>'jwt',
                'provider'=>'jwt'
            ],




        ],

        'providers' => [

            'jwt' => [
                'driver' => 'eloquent',
                'model' => Tiniy\Api\Models\JwtUser::class,//对应第二步创建的
            ]


        ],
    ],





];
