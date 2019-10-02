<?php
namespace Tiniy\Api\Http\Api\V1;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use phpDocumentor\Reflection\Types\Null_;
use Tiniy\Api\Http\Api\Controller;

use Illuminate\Http\Request;
use Tiniy\Api\Models\defined;


/**
 */
class QueryAllController extends Controller
{
   protected $guard = 'apijwt';//设置使用guard为api选项验证，请查看config/auth.php的guards设置项，重要！
//

   protected  $model = '';
   protected  $table = '';
   protected  $where = '';

    public function __construct(Request $request)
    {

        $this->middleware('jwt.auth:apijwt', ['except' => ['login','register']]);



    }
   // protected $fillable = ['name', 'email','password'];



    public function selectSql()
    {

        $res =  DB::select(config('userApi.selectSql'));
        return response()->json($res);

    }

    public function updateSql()
    {


        $res =  DB::update(config('userApi.updateSql'));
        return response()->json($res);

    }

    public function insertSql()
    {


        $res =  DB::insert(config('userApi.insertSql'));
        return response()->json($res);

    }
    public function deleteSql()
    {


        $res =  DB::delete(config('userApi.deleteSql'));
        return response()->json($res);

    }







}