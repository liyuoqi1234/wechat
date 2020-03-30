<?php

namespace App\Http\Controllers\login;

use App\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Login;
use Illuminate\Support\Facades\Cache;

class LoginController extends Controller
{
    public function login()
    {
        return view('login.login');   
    }

    public function dologin(Request $request)
    {
        $username = $request->input('username');
        $pwd = $request->input('pwd');
        $data = Login::where(['username'=>$username,'pwd'=>$pwd])->first();
        // dd($data);
        if(!$data){
            echo '用户名或密码错误，请重新登录';die;
        }else{
            // 生成token
            $token = md5($data['user_id'].time());
            // 写入token
            $data->token=$token;
            // token有效时间
            $data->ex_time = time()+7200;
            $data->save();
            return json_encode(['code'=>200,'msg'=>'登录成功','data'=>$token]);
        }
    }

    public function tiqi()
    {
        
    }
}

?>