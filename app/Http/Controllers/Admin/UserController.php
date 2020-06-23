<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;
class UserController extends Controller
{
    public function center(){
        $userInfo=session('userInfo');
        $user_id=$userInfo['user_id'];
        //echo $user_id;
        $res=User::where("user_id",$user_id)->first();
        //dd($res);
        return view('admin/center',['res'=>$res]);
    }
}
