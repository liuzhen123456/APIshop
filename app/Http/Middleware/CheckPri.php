<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;
class CheckPri
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //echo 123;die;
        $token=$request->input('token');
        $uid=Redis::get($token);
        if(!$uid){
            $response=[
                'err_code'=>10008,
                'err_msg'=>"鉴权失败"
            ];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);die;
        }

        return $next($request);
    }
}
