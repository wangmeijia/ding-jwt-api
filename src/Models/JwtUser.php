<?php

namespace Tiniy\Api\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;//比User.php多了这个引入，下面并且继承这个接口
use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Tiniy\Api\Models\ModelConfig;


class JwtUser extends Authenticatable implements JWTSubject
{
      use Notifiable;



      protected   $table = "users" ;
      protected $fillable = ['name', 'email','password'];
      protected $hidden = ['password', 'remember_token'];

//     //public  $table = $this->getConfig();
//
//
//






    public static function create(array $attributes = [])
    {
        $model = new static($attributes);

        //$model->fillable(ModelConfig::getFillables()); //改不了，想不到其它方法
        //$model->save();
        //$this->fillable = ModelConfig::getFillables();
        $model->setTable(ModelConfig::getAuthTables() );

        $model->save();
        return $model;



    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }




}
