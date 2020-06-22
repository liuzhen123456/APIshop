<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //声明表名
    public $table="p_users";
    //主键
    protected $primaryKey="user_id";
    //时间戳
    public $timestamps=false;
    //create添加时的黑名单
    protected $guarded=[];

}
