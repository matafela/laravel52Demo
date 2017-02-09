<?php

namespace App\Http\Middleware;

use Closure;

class Activity
{
    /**
     * Handle an incoming request.(前置中间件）
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        //通过时间判断(time() < strotime('2017-02-08'))
        if($request->input('id') == 0){
            return redirect('activity/activity0');
        }

        return $next($request);//请求通过，直接接入下一层
    }

    /**
     * 后置中间件，获取的是最终的响应，前置中间件获取的是最初的请求
     * @param $request
     * @param Closure $next
     */
//    public function handle($request, Closure $next){
//        $response = $next($request);
//
//        // 执行动作
//
//        return $response;
//
//    }
}
