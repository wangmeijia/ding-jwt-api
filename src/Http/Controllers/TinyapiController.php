<?php
namespace Tiniy\Api\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

/**
 * 这是一个控制器 需要继承一个laravel所提供的控制器
 */
class TinyapiController extends Controller
{
    ///theapi/register
    public function  register() {

        echo "sss";

        echo  'register';
    }
    public function index()
    {

        echo "sss";
    }


    public function store(Request $request)
    {

    }
}
