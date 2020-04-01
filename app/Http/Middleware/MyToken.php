<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\login;
use Illuminate\Support\Facades\Cache;

class MyToken
{

    // handle头
    public function handle($request, Closure $next)
    {
       $userData = $this->checkToken($request);
       $mid_params = ['userData'=>$userData];
       $request->attributes->add($mid_params);  //添加参数
        // 根据IP防刷
        // 获取到IP  $_SERVER['REMOTE_ADDR'];
        $ip = $_SERVER['REMOTE_ADDR'];//获取IP
        // 记录当前IP  1分钟访问了接口多少 存到缓存里
        $cache_name = "pass_time_".$ip;
        // 上一次访问了多少次
        $num = Cache::get($cache_name);
        if(!$num){
            $num = 0;
        }
        if($num > 10){
            // ip记录到文件  服务器端配置屏蔽某个IP
            echo json_encode(['ret'=>201,'msg'=>'访问接口过于频繁，请稍后']);die;
        }
        $num += 1;
        Cache::put($cache_name,$num,60);

       return $next($request);
    }

    // token
    public function checkToken($request)
    {
        // 接收从前台过来的token
        $token = $request->input('token');
        // dd($token);
        // dd($token);
        if(empty($token)){
            return json_encode(['code'=>201,'msg'=>'请先登录']);
        }
        // dd($token);
        // 查询库里面的token和当时的token是否一致
        $userData = Login::where('token',$token)->first();
        // dd($userData);
        // 检测token是否正确
        if(!$userData){
            return json_encode(['code'=>201,'msg'=>'请先登录']);
        }
        // 判断token有效期
        if(time()>$userData['ex_time']){
            return json_encode(['code'=>203,'msg'=>'出现异常，请您重新登录']);
        }
        // 如果用户再次调用接口则增加有效期
        $userData->ex_time = time()+7200;
        $userData->save();

        return $userData;
    }
}