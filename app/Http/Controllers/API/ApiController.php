<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;
use App\Model\Token;
use Illuminate\Support\Facades\Redis;
class ApiController extends Controller
{
    /*
     *  登录
     */

    public function login(Request $request){
        $post=$request->except('_token');
        $user_name=$request->user_name;
        $password=$request->password;
        $userInfo=User::where("user_name",$user_name)->first();
        //dump($userInfo);
        if($userInfo){
            $res=password_verify($password,$userInfo['password']);
            if($res){
                //生成token
                 $str=$userInfo->user_id . $userInfo->user_name . time();
                 $token=substr(md5($str),10,16);
                 $response=[
                        'err_code'=>"0",
                        'err_msg'=>"登陆成功",
                        'token'=>$token
                 ];
                //将token入库
                $data=[
                    'user_id'   =>  $userInfo->user_id,
                    'token'     =>  $token
                ];
                //将token存入redis
                Redis::set($token,$userInfo->user_id);
            }else{
                //密码不对 返回错误信息
                $response=[
                    'err_code'=>"10001",
                    'err_msg'=>"账号密码错误"
                ];
            }
            return $response;
        }


        //未查询到用户名
        if(!$userInfo){
            $response=[
                'err_code'=>"10002",
                'err_msg'=>"账号密码错误"
            ];
            return $response;
        }
    }

    /*
     * 注册
     */

    public function reg(Request $request){
        //接受表单传递的值
        $user_name=$request['user_name'];
        $user_email=$request['user_email'];
        $user_pwd=$request['password'];
        $user_pwds=$request['password_s'];

        //验证规则
        if($user_pwd!=$user_pwds){
            $response=[
                'err_code'=>"10001",
                'err_msg'=>"密码与确认密码不相同，请重新输入"
            ];
            return $response;
        }
        if(!$user_name){
            $response=[
                'err_code'=>"10002",
                'err_msg'=>"用户名不能为空，请重新输入"
            ];
            return $response;
        }
        if(!$user_email){
            $response=[
                'err_code'=>"10003",
                'err_msg'=>"邮箱不能为空，请重新输入"
            ];
            return $response;
        }
        //检测用户名是否存在
        $u=User::where(['user_name'=>$user_name])->first();
        if($u){
            $response=[
                'err_code'=>"10004",
                'err_msg'=>"用户名已存在，请重新输入"
            ];
            return $response;
        }
        $data=[
            "user_name"=>$user_name,
            "user_email"=>$user_email,
            "password"=>$user_pwd,
            "reg_time"=>time()
        ];
        $data['password']=password_hash($user_pwd,PASSWORD_BCRYPT);
        $res=User::insert($data);
        //dump($res);
        if($res){
            $response=[
                'code'=>"0",
                'msg'=>"注册成功"
            ];

        }else{
            $response=[
                'err_code'=>"10005",
                'err_msg'=>"注册失败"
            ];
        }
    }

    /*
     * 个人中心
     */
    public function center(){

        if(isset($_GET['token'])){
            $token=$_GET['token'];
            $res=Redis::get($token);
            if($res){
                $userInfo=User::find($res);
                echo "欢迎".$userInfo->user_name."登录";
                //var_dump($userInfo);
                //dd($res);
                //return view('admin/center',['res'=>$res]);
            }
        }else{
            $response = [
                'err_code' => 10003,
                'err_msg'  => '请先登录'
            ];
            return $response;
        }
    }

    public function orders(){


        $arr=[
            '567636456456421189912',
            '126864564564218788934',
            '685464564564218789956',
            '985464564564218789989',
        ];
        $response=[
            'err_code'  =>  0,
            'err_msg'   =>  'ok',
            'data'      =>  [
                'orders'    =>  $arr
            ]
        ];
        return $response;
    }
    public function cart(){

        $goods=[
            123,456,789
        ];
        $response=[
            'err_code'=>0,
            'err_msg'=>'ok',
            'data'=>$goods
        ];
        return $response;

    }
}
