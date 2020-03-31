<?php

namespace App\Http\Controllers\logins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ZhucModel;
use Illuminate\Support\Facades\Cache;

class LoginsController extends Controller
{

    // 注册
    public function zhuc()
    {
        return view('logins.zhuc');
    }

    // 执行注册
    public function dozhuc(Request $request)
    {
        $data = $request->all();

        if($data['z_name'] == ''){
            return json_encode(['code'=>202,'msg'=>'用户名不能为空']);die();
        }

        $info = ZhucModel::first(['z_name']);
        // dd($info);
        if($data['z_name'] == $info['z_name']){
            return json_encode(['code'=>203,'msg'=>'用户名已存在，请重新输入']);die();
        }

        // dd($data);
        $datainfo = ZhucModel::create($data);
        // dd($datainfo);
        if($datainfo){
            return json_encode(['code'=>200,'msg'=>'添加成功']);
        }else{
            return json_encode(['code'=>201,'msg'=>'添加失败']);
        }
    }

    // 登录
    public function login()
    {
        return view('logins.login');
    }

    public function dologin(Request $request)
    {
        $z_name = $request->input('z_name');
        $z_pwd = $request->input('z_pwd');
        $loginInfo = ZhucModel::where(['z_name'=>$z_name,'z_pwd'=>$z_pwd])->first();
        if(!$loginInfo){
            return json_encode(['code'=>203,'msg'=>'用户名或者密码不正确，请重新输入']);die;
        }
        if($loginInfo){
            return json_encode(['code'=>200,'msg'=>'登录成功']);
        }else{
            return json_encode(['code'=>201,'msg'=>'登录失败']);
        }
    }

}
