<?php
/**
 * Created by PhpStorm.
 * User: len
 * Date: 2016/11/25
 * Time: 0:21
 */
namespace App\Http\Controllers;
use App\Member;
class MemberController extends Controller{
    public function info(){
        return route('memberInfo');//通过路由名称输出路由别名
    }

    public function getId($id){
        return $id;
    }

    public function returnView(){
        //resources/views名下
        return view('member/info');
    }

    public function returnView2(){
        //resources/views名下
        //使用blade模板引擎绑定参数
        return view('member/info2',[
            'name'  =>'poi',
            'age'   =>18
        ]);
    }

    public function useModel(){
        return Member::getMember();
    }
}