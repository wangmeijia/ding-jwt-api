<?php

namespace Tiniy\Api\Models;



class ModelConfig
{
    protected $authDrive = 'userApi';


     static function getAuthTables() {
         $tableName = config('userApi.A_TABLE');
         return $tableName;

    }

    static function getFillables () {
        $fields = config('userApi.A_FILLABLE');
        return $fields;

    }

    static function getRegisteFields () {
        $fields = config('userApi.REGISTER_FILELDS');
        return $fields;

    }

    static function getloginFields () {
        $fields = config('userApi.LOGIN_FILELDS');
        return $fields;
    }







}
