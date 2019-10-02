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

        //$this->middleware('jwt.auth:apijwt', ['except' => ['login','register']]);



    }



    public function selectSql(Request $request)
    {
        $res = array('code'=>000,'msg'=>'执行成功');
        $string = $request->route('string');
        if($string=='') {
            $res = array('code'=>111,'msg'=>'执行失败，请在路由中设置路由参数！','data'=>array());
        }else {
           // DB::enableQueryLog();

           // echo config('userApi.selectSql.'.$string);

            $res['data'] = DB::select(config('userApi.selectSql.'.$string));

           // return response()->json(DB::getQueryLog());

        };

        return response()->json($res);

    }

    public function updateSql(Request $request)
    {
        $string = $request->route('string');
        $res = array('code'=>000,'msg'=>'执行成功');

        if($string=='') {
            $res = array('code'=>111,'msg'=>'执行失败，请在路由中设置路由参数！','data'=>array());
        }else {
            $res['data'] = DB::update(config('userApi.updateSql.'.$string));

        };

        return response()->json($res);

    }

    public function insertSql(Request $request)
    {
        $string = $request->route('string');
        $res = array('code'=>000,'msg'=>'执行成功');

        if($string=='') {
            $res = array('code'=>111,'msg'=>'执行失败，请在路由中设置路由参数！','data'=>array());
        }else {
            $res['data'] = DB::insert(config('userApi.insertSql.'.$string));

        };

        return response()->json($res);

    }
    public function deleteSql(Request $request)
    {

        $string = $request->route('string');
        $res = array('code'=>000,'msg'=>'执行成功');

        if($string=='') {
            $res = array('code'=>111,'msg'=>'执行失败，请在路由中设置路由参数！','data'=>array());
        }else {


            $res['data']  = DB::delete(config('userApi.deleteSql.'.$string));
        }
        return response()->json($res);

    }







}