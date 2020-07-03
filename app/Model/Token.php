<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    //声明表名
    public $table="token";
    //主键
    protected $primaryKey="id";
    //时间戳
    public $timestamps=false;
    //create添加时的黑名单
    protected $guarded=[];
}
