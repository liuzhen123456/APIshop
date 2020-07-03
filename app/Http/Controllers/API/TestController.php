<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
class TestController extends Controller
{
    public function a(){
        $request_uri=$_SERVER['REQUEST_URI'];
        echo 'request_uri：'.$request_uri;echo '<br>';
        echo 'A方法';echo '<br>';
        $key='access_total_'.$request_uri;
        echo $key;die;
        $total=Redis::incr($key);
        echo "当前访问次数为".$total;
    }
}
