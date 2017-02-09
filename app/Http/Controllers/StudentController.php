<?php
/**
 * Created by PhpStorm.
 * User: len
 * Date: 2016/11/29
 * Time: 0:35
 */
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Student;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller{
    public function test1(){
        #DB门面行原生SQL操作

        /*$student = DB::select('select * from `student`');//查询成功返回数组
        dd($student);*/

        //$bool = DB::insert('INSERT INTO student(name,age) VALUES (?,?)',['sean',18]);//insert操作回返回一个bool值，true为操作成功

        /*$num = DB::update('UPDATE student set age = ? WHERE name = ?',['20','sean']);
        dd($num);*///更新成功后返回更新的行数

        /*$num = DB::delete('DELETE FROM student where id > ?',[1]);//返回删除的行数
        var_dump($num);*/


        #查询构造器

        //插入
        /*$bool = DB::table('student')->insert(
            [
                'name'  =>'imooc',
                'age'   =>18
            ]
        );
        dd($bool);*/

        //插入并得到ID
        /*$id = DB::table('student')->insertGetId(
            [
                'name'  =>'po',
                'age'   =>19
            ]
        );
        dd($id);*/

        //多维数组实现批量插入
        /*$bool = DB::table('student')->insert([
            [
                'name'  =>'name1',
                'age'   =>18
            ],
            [
                'name'  =>'name2',
                'age'   =>18
            ]
        ]);
        dd($bool);*/


        //更新
        //$num 返回的是被影响的行数
        /*$num = DB::table('student')
            ->where('id', 1)//也可以where('id','=',1)
            ->update([
                'age' => 1
            ]);
        dd($num);*/

        //自增
        //$num = DB::table('student')->increment('age');//加1，但是不带条件会全部加
        //$num = DB::table('student')->increment('age',3);//加3
        //$num = DB::table('student')->decrement('age');//减1
        //$num = DB::table('student')->decrement('age',3);//减3
        /*$num = DB::table('student')
            ->where('id','>',3)
            ->increment('age');//加1,最好带一下where条件
        dd($num);*/


        //删除
        /*$num = DB::table('student')//返回被影响行数
            ->where('id', '<=',3)
            ->delete();
        dd($num);*/
        //清除整张表，也就是删除所有列并将自增ID置为0
        //DB::table('student')->truncate();//不返回任何数据

        //查询

        //get()取全部数据
        //$student = DB::table('student')->get();
        //注：这里输出的格式（$student)：
        /*
         * array=>[
         *     object=>{(是stdClass)
         *         列的名称：值
         *         ...
         *     }
         * ]
         * 优点是可以直接封装为json格式
         */
        //echo '<pre>';
        //var_dump($student);

        //first()取结果集中第一条数据
        /*$student = DB::table('student')
            ->where('id','>=',3)
            ->first();*/
        //注：这里输出的格式（$student)：
        /*
         * object=>{(是stdClass)
         *     列的名称：值
         *     ...
         * }
         * 优点是可以直接封装为json格式
         */
        /*echo '<pre>';
        var_dump($student);*/

        //whereRaw()执行原生wherer语句（更加灵活，可以组合多个条件
        /*$student = DB::table('student')
            ->whereRaw('id >= ? and age <= ?',[3,15])
            ->get();
        dd($student);*/

        //pluck获取结果集中指定的列。
        /*$nameList = DB::table('student')
            ->whereRaw('id >= ? and age <= ?',[3,15])
            ->pluck('name');
        echo '<pre>';
        var_dump($nameList);*///返回的结果集是一个数组

        //lists获取结果集中指定的列
        //同pluck的
        /*$nameList = DB::table('student')
            ->whereRaw('id >= ? and age <= ?',[3,15])
            ->lists('name');
        echo '<pre>';
        var_dump($nameList);*///返回的结果集是一个数组
        //以指定的列作为键
        /*$nameList = DB::table('student')
            ->whereRaw('id >= ? and age <= ?',[3,15])
            ->lists('name','id');
        echo '<pre>';
        var_dump($nameList);*/

        //select选取列
        /*$student = DB::table('student')
            ->select('id','age','name')
            ->get();
        echo '<pre>';
        var_dump($student);*///返回的格式同get()

        //chunk分段获取
        /*echo '<pre>';
        DB::table('student')->chunk(2,function($student){//每次获取两个，获取了以后执行这个回调函数
            echo '<hr>';
            var_dump($student);

            //指定条件下return false可以停止查找
            if($student[0]->id==3||$student[1]->id==3)
                return false;
        });*/

        //聚合函数
        /*$num = DB::table('student')//
            ->where('id', '<=',3)
            //->count();
            //->max('age');
            //->min('age);
            //->avg('age');
            ->sum('age');
        echo $num;*/

    }

    public function orm1(){
        //all()
//        $student = Student::all();
//        echo '<pre>';
//        var_dump($student);//返回一个很复杂的模型对象数组（集合collection），具体参数在模型对象里的attribute属性里

        //find()通过主键获取
//        $student = Student::find(3);//通过主键获取
//        echo '<pre>';
//        var_dump($student);

        //first()通过where（）获取
        //orm中也可以直接使用查询构建器的方法，但是返回的是一个（集合collection），不过调用里面东西时也可以使用查询构建器时的方法
        //
        /*$student = Student::select('id','age','name')
            ->get();//where('id','=',3)->first();
        echo '<pre>';
        var_dump($student);*/

        //findOrFail()未找到结果时直接抛出异常
        //$student = Student::findOrFail(53);

        //使用模型新增对象
        /*$student = new Student();
        $student->name = 'sean';
        $student->age = 215;
        $bool = $student->save();//save()成功时insert
        dd($student);*/

        //输出时间戳注意事项
//        $student = Student::find(9);
//        echo $student->updated_at;

        //使用Create方法增加数据
//        $student = Student::create(
//            ['name'=>'name215','age'=>56]
//        );
//        dd($student);

        //firstOrCreate()方法先尝试通过给定列/值对在数据库中查找记录，找到就返回找到的模型实例，如果没有找到的话则通过给定属性创建一个新的记录。
//        $student = Student::firstOrCreate(
//            ['name'=>'name216','age'=>0]
//        );
//        dd($student);

        //firstOrNew方法和firstOrCreate方法一样先尝试在数据库中查找匹配的记录，如果没有找到，则返回一个的模型实例。
        //注意通过firstOrNew方法返回的模型实例并没有持久化到数据库中，你还需要调用save方法手动存储：
//        $student = Student::firstOrNew(
//            ['name'=>'name216']
//        );
//        $bool = $student->save();
//        dd($student);

        //基本更新(获取后再save即可，并且会自动维护update时间戳
//        $student = Student::find(1);
//        $student->name = 'jian';
//        $bool = $student->save();     //P.S使用查询构建器里的update也是可以的
//        dd($bool);

        //删除,通过模型，find以后delete
//        $student = Student::find(1);
//        $bool = $student->delete();
//        var_dump($bool);

        //知道主键后，直接destroy
//        $num = Student::destroy(1,23,56,5,6);//返回删除几条记录,删除以上ID

        //where删除
//        $num = Student::where('id','>',5)->delete();



    }

    //注:要是Illuminate\Http\Request;别选错了
    public function request1(Request $request){//类注入，获取Request的一个对象
        //取值
//        echo $request->input('name','未知');//第二个参数为默认值
        //判断有没有
//        var_dump($request->has('name'));
        //获取所有参数
//        dd($request->all());//返回数组
        //判断请求类型
//        echo $request->method();
        //判断是不是ajax请求
//        var_dump($request->ajax());
        //获取当前url
//        echo $request->url();
        //判断当前url格式是否符合
//        var_dump($request->is('student/*'));//默认已经到public下了


    }

    public function session1(Request $request){

        //Http request session
//        $request->session()->put('key1','value1');
//        echo $request->session()->get('key1');

        //session()函数
//        session()->put('key2','value2');
//        echo session()->get('key2');

        //Session静态方法，优选
//        Session::put('key3','value3');
//        echo Session::get('key3');

        //获取session的get方法可以加上默认值
//        echo Session::get('key4','default');

        //Session还可以批量存放(虽然有点无语，但是是这样使用的
//        Session::put(['key4'=>'value4','key5'=>'value5']);
//        dd(Session::get('key4'));
//        dd(Session::get('key5'));

        //Session内存放数组值
        //方法1
//        Session::put('array1',['sean','name']);
//        dd(Session::get('array1'));
        //方法2
//        Session::push('array2','sean');
//        Session::push('array2','name');
//        dd(Session::get('array2'));

        //Session::pull中取指定列的值，取完删除
//        Session::put('key3','value3');
//        echo Session::pull('key3');
//        echo Session::get('key3','notFound');

        //Session::has()看指定列名的值是否存在
//        var_dump(Session::has('key5'));

        //Session::取所有的值
//        $res = Session::all();
//        echo '<pre>';
//        var_dump($res);

        //Session::forget()方法清除Session指定列值的内容
//        Session::put('key3','value3');
//        Session::forget('key3');
//        $res = Session::all();
//        echo '<pre>';
//        var_dump($res);

        //Session::flush()清除所有session
//        Session::flush();
//        $res = Session::all();
//        echo '<pre>';
//        var_dump($res);

        //Session::flash()??仅第一次请求时生效？？（快闪数据）
//        Session::flash('key1d','value1');
//        dd(Session::all());

    }

    public function session2(Request $request){
//        echo Session::get('key1d','NotFound');
        echo Session::get('Msg','NotFound');

    }

    public function response1(){
        //响应json
//        $data = [
//            'errCode'   =>0,
//            'errMsg'    =>'sucess',
//            'data'      =>'poi',
//        ];
//        return response()->json($data);

        //重定向redirect
//        return redirect('student/session2')->with('Msg','po');//里面的名称是路由的名称,with里带的是一次性session信息。（快闪数据）

        //action重定向
//        return redirect()->action('StudentController@session2')->with('Msg','po');

        //route通过路由别名跳转
//        return redirect()->route('session2')->with('Msg','po');

        //cookie()方法添加cookie到响应
//        return redirect()->route('session2')->cookie('name', 'value');

    }

    //活动宣传页面
    public function activity0(){
        return '活动快要开始了，敬请期待';
    }

    public function activity1(){
        return '活动1进行中';
    }

    public function activity2(){
        return '活动2进行中';
    }

    public function upload(Request $request){
//        //判断请求中是否包含name=file的上传文件
//        if(!$request->hasFile('file')){
//            exit('上传文件为空！');
//        }
        $file = $request->file('file');
//        //判断文件上传过程中是否出错
//        if(!$file->isValid()){
//            exit('文件上传出错！');
//        }
//        $destPath = realpath(public_path('images'));
//        if(!file_exists($destPath))
//            mkdir($destPath,0755,true);
//        $filename = $file->getClientOriginalName();
//        if(!$file->move($destPath,$filename)){
//            exit('保存文件失败！');
//        }
//        exit('文件上传成功！');

        //取源文件名
//        $filename = $file->getClientOriginalName();
        //取文件拓展名
//        $ext = $file->getExtension();
        //取文件类型
//        $type = $file->getClientMimeType();
        //取文件的临时路径
//        $realPath = $file->getRealPath();
        //保存文件
//        $newFileName = date('Y-m-d-H-i-s').'-'.uniqid().$ext;
//        $bool = Storage::disk('uploads')->put($newFileName,file_get_contents($realPath));
    }

    public function download(Request $request){
        //第一个参数：服务器端文件名，第二个：下载后显示的名字，第三个为响应头
//        return response()->download($pathToFile, $name, $headers);
    }

}