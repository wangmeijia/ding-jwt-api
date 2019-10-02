<?php
namespace Tiniy\Api\Http\Api\V1;

use Illuminate\Support\Facades\URL;
use phpDocumentor\Reflection\Types\Null_;
use Tiniy\Api\Http\Api\Controller;

use Illuminate\Http\Request;
use Tiniy\Api\Models\defined;


/**
 * 这是一个控制器 需要继承一个laravel所提供的控制器
 */
class QueryController extends Controller
{
  // protected $guard = 'apijwt';//设置使用guard为api选项验证，请查看config/auth.php的guards设置项，重要！
//

   protected  $model = '';
   protected  $table = '';
   protected  $where = '';

    public function __construct(Request $request)
    {

       // $this->middleware('jwt.auth:apijwt', ['except' => ['login','register']]);

        $this->model  = new defined();



    }
   // protected $fillable = ['name', 'email','password'];



    public function getOne(Request $request)
    {
        return $request->route('string');

        if($request->segment(2)) {
            $table = $request->segment(2);
        }
        $Model = new defined();
        $M = $Model->setTableName($table);
        $fields = $this->parseFilelds(preg_replace('# #','',$string));
        $res = $M->where($fields)->get();
        return response()->json($res);

    }

    /*
     *@to针对不同的字段最应该加验证字段，暂时精力有限
     *
     */

    public function postDatas(Request $request) {
        $this->setTableName($request->segment(3));
        $Fields = $request->all();
        $res = $this->model->setMtableName($this->table)->forceCreate($Fields);
        return response()->json($res);

    }

    /*
     *
     */

    public function putDatas(Request $request,$string) {
        //return $string;
        $this->setTableName($request->segment(3));
        $Fields = $request->post();
        $where  = $this->parseFilelds(preg_replace('# #','',$string));
        $res = $this->model->setMtableName($this->table)->where($where)->update($Fields);
        return response()->json($res);

    }

    /*
     *
     *
     */

    public function deleteDatas(Request $request,$string) {
        $this->setTableName($request->segment(3));
        $where  = $this->parseFilelds(preg_replace('# #','',$string));
        $res = $this->model->setMtableName($this->table)->where($where)->delete();
        return response()->json($res);

    }


    //对不同的路由情况需要单独设置
    private function setTableName ($tablename) {
        $this->table  =  $tablename;
    }




    protected function parseFilelds($fields) {
        $where = array();
        if ($fields != '') {
            $fields = explode('&', $fields);
            foreach ($fields as $field) {

                $query = explode('=', $field);
                if( !empty($query[1] ) )  {
                    $where[$query['0']] = $query[1];
                }else {
                    $where[$query['0']] = null;

                }

            };
        }

        return $where;

    }




}