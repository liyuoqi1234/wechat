<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    // 首页
    public function index()
    {
        return view('index/index');
    }

    // 详情
    public function xiqi()
    {
        return view('index/xiqi');
    }
}
