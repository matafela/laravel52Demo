<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('basic',function(){
    return 'asdf';
});

//多请求路由
Route::match(['get','post'],'multy1',function(){
    return 'asd';
});
Route::any('multy2',function(){
    return 'oh';
});

//路由参数
/*oute::get('user/{id}',function($id){
    return 'User-'.$id;
});*/

//路由参数（正则约束&可选参数）
Route::get('user/{id}/{name?}',function($id,$name = 'sean'){
    return 'User-'.$id.'-'.$name;
})->where([
    'name'  =>'[A-Za-z]+',
    'id'    =>'[0-9]+'
]);

//路由别名
Route::get('user/member-center',['as'=>'center',function(){
    return route('center');
}]);
//路由群组
Route::group(['prefix'=>'member'],function(){
    Route::get('poison',function(){
        return 'poi';
    });

    Route::get('sad',function(){
        return 'sad';
    });
});

//路由中输出视图
Route::get('view',function(){
    return view('welcome');
});

//调用控制器
Route::get('member/info','MemberController@info');
//方法2
//Route::get('member/info',['uses'=>'MemberController@info']);
//调用控制器时命别名
Route::get('member/info2',[
   'uses'   =>'MemberController@info',
    'as'    =>'memberInfo'
]);
//调用控制器时，参数绑定，正则约束
Route::get('member/getId/{id}',[
    'uses'   =>'MemberController@getId',
])->where(['id'=>'[0-9]+']);

//视图使用调用路由
Route::get('member/infoPage','MemberController@returnView');

Route::get('member/infoPage2','MemberController@returnView2');

//简单调用模型
Route::get('member/useModel','MemberController@useModel');


Route::group(['prefix'=>'student'],function(){
    //使用DB Facade和查询构造器
    Route::get('test1','StudentController@test1');
    //使用orm
    Route::get('orm1','StudentController@orm1');
    //请求
    Route::get('request1','StudentController@request1');
    //session，但是要记得加上路由中间件
    Route::group(['middleware'=>['web']],function(){//这个叫'web'的中间件里加入了session启动指令
        Route::get('session1','StudentController@session1');
        Route::get('session2',[
            'as'    =>'session2',
            'uses'  =>'StudentController@session2'
        ]);
    });

    //response测试
    Route::get('response1','StudentController@response1');

    //文件上传
    Route::any('upload','StudentController@upload');

});

Route::group(['prefix'=>'activity'],function(){
    Route::get('activity0',['uses'=>'StudentController@activity0']);

    Route::group(['middleware'=>['activity']],function() {
        Route::get('activity1', ['uses' => 'StudentController@activity1']);
        Route::get('activity2', ['uses' => 'StudentController@activity2']);
    });
});
Route::auth();

Route::get('/home', 'HomeController@index');
