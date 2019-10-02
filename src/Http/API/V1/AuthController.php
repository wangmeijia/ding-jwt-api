<?php
namespace Tiniy\Api\Http\Api\V1;

use Tiniy\Api\Http\Api\Controller;
use Illuminate\Http\Request;
use  Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Tiniy\Api\Models\JwtUser;
use Illuminate\Support\Facades\Validator;
use Tiniy\Api\Models\ModelConfig;


/**
 * 这是一个控制器 需要继承一个laravel所提供的控制器
 */
class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     * 要求附带email和password（数据来源users表）
     * @return void
     */
    protected $guard = 'apijwt';//设置使用guard为api选项验证，请查看config/auth.php的guards设置项，重要！

    public function __construct()
    {

        $this->middleware('jwt.auth:apijwt', ['except' => ['login','register']]);


    }

    /*
     *
     * 测试登录路由
     *
     * \?token = eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMVwvdGhlYXBpXC9yZWdpc3RlciIsImlhdCI6MTU2NzY2MzA0MiwiZXhwIjoxNTY3NjY2NjQyLCJuYmYiOjE1Njc2NjMwNDIsImp0aSI6InV4VldaWmFUMWRTS0hUQXIiLCJzdWIiOjE0LCJwcnYiOiIwM2ExMTNiZjJlMDRiMjc1NTUwMjI1NGZlMjA1MThjZTU5OTZhM2Q3In0.8WRl7v2arSSbp-iUv9yD_yD7kUEmbKZLDgnmm91clbU
     */

    public function index(){
        echo 'Your has login ';
        $token = JWTAuth::getToken();
        //return $token;
        $user = JWTAuth::parseToken()->authenticate();
        echo "\n".var_dump($user);
    }

    /*注册*/
    public function register(Request $request)
    {


        $this->validator($request->all())->validate();

        $postDatas = config('userApi.register_filelds');
        $credentials = [
            //'email' => $request->input('email'),
            $postDatas['loginName'] => $request->input( $postDatas['loginName']),
            $postDatas['password'] => bcrypt($request->input($postDatas['password'])),
        ];
        foreach ($postDatas['others'] as $fields) {
            $credentials[$fields]= $request->input($fields);
        }

        $user = JwtUser::create($credentials);


        if($user)
        {
            $token = JWTAuth::fromUser($user);
            return response()->json(['result' => $token]);
        }

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data,  config('userApi.register_validator'));
    }

    /*登录*/
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth('apijwt')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth('apijwt')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('apijwt')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     * 刷新token，如果开启黑名单，以前的token便会失效。
     * 值得注意的是用上面的getToken再获取一次Token并不算做刷新，两次获得的Token是并行的，即两个都可用。
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('apijwt')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('apijwt')->factory()->getTTL() * 60
        ]);
    }
}