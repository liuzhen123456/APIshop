<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;
class LoginController extends Controller
{
    public function login(){
        return view('admin/login');
    }
    public function login_do(Request $request){
        $post=$request->except('_token');
        $user_name=$request->user_name;
        $password=$request->password;
        $userInfo=User::where("user_name",$user_name)->first();
        $res=password_verify($password,$userInfo['password']);
        if($userInfo){
            if(!$res){
                echo "账号密码错误";
                return redirect(url('/login/login'));
            }
        }
        if(!$userInfo){
            echo "账号密码错误";
            return redirect(url('/login/login'));
        }
        session(['userInfo'=>$userInfo]);
        return redirect(url('/user/center'));
        //dump($userInfo);
    }


    public function reg(){
        return view('admin/reg');
    }
    public function reg_do(Request $request){
        $post=request()->except('_token');

        //dump($request);
        //接受表单传递的值
        $user_name=$request['user_name'];
        $user_email=$request['user_email'];
        $user_pwd=$request['password'];
        $user_pwds=$request['password_s'];

        //验证规则
        if($user_pwd!=$user_pwds){
            echo "密码不相同";die;
        }
        $request->validate([
            "user_name"=>"required|unique:p_users",
            "user_email"=>"required",
            "password"=>"required",
            "password_s"=>"required"
        ],[
            "user_name.required"=>"用户名不能为空",
            "user_name.unique"=>"用户名已存在",
            "user_email.required"=>"邮箱不能为空",
            "password.required"=>"密码非空",
            "password_s.required"=>"确认密码非空"
        ]);
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
            return redirect(url('/login/login'));
        }
    }

    public function test(){
        session(['userInfo'=>null]);

    }
}
