<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //指定表名
    protected $table = 'student';

    //指定主键名，默认为'id'
    //protected $primaryKey = 'id';

    public $timestamps = true;//设为false时不自动更新updated_a和created_at

    public $fillable = ['name','age'];//指定允许create方法赋值的字段

    public $guarded = ['id','updated_at','created_at'];//指定不允许create方法赋值的字段

    protected function getDateFormat(){//设置获取时间戳的方式
        return time();
    }

    protected function asDateTime($value){//不写这个echo时间戳的时候还会自动格式化一下，好烦
        return $value;
    }

}
