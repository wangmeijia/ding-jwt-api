<?php

namespace Tiniy\Api\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class defined extends Model
{
    //

    protected   $table = '';
    //protected $fillable = ['name', 'email','password'];




    public function setTableName($table) {
        return DB::table($table);


    }

    public function setMtableName($table) {
        $this->table=$table;
        return $this;
    }



//    function where($where){
//
//        return $where;
//
//    }


//    public function get() {
//       return $this->get();
//    }

}
