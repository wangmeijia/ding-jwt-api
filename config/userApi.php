<?php
return [

    'A_TABLE' => 'users',//数据库名
    'A_FILLABLE' => [ 'email','password'],//设置哪些数据可以添加到白名单
    'register_validator'=>[
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:6'],
        ],//需要验证的字段

    'register_filelds'=>[
        'loginName' => 'name',
        'password' => 'password',
        'others' =>['email']
    ],

    'LOGIN_FILELDS'=>[ 'loginName'=>'email','loginPwd'=>'password'],//登录验证字段，另一个password是不可更改的字段



//    'router'=>[
//        ['table'=>'users','fields'=>'name=meijia&email=wangmeijia17@163.com'],
//        ['table'=>'users','fields'=>'name=a&email=b@163.com'],
//    ],
    'selectSql'=>"select * from users where id = 48",
    'updateSql'=>"update users set name = 1233 where NAME = 'se'",
    'insertSql'=>"insert into users (NAME,email,password) VALUEs ('呀','ab@163.com','swoee') ",
    'deleteSql'=>"delete from users WHERE id=51",




];
