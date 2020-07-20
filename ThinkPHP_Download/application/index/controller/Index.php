<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use app\common\model\Files;
use app\common\model\User;

class Index extends Controller
{
    // 主页
    public function index(Request $request)
    {
        return view("index@index/index");
    }

    // 搜索
    public function search(Request $request){
        $res2 = $request->post();
        $res = null;
        foreach($res2 as $k=>$v){
            $res = $k;
        }
        if($res){
           $data = Files::where('title', 'like', "%".$res."%")->paginate(6);
           $page = '以上是全部内容';
           $all = [$data,$page];
           echo json_encode($all);
        }
    }

    // 无刷新分页
    public function ajax(Request $request){
        $data = Files::paginate(6);
        $page = $data->render();
        $all = [$data,$page];
        echo json_encode($all);
    }
    
    // 下载页
    public function download(){
        $id = input('id');
        $data = Files::where('id','=',$id)->find();
        if(session('username')){
            return view('index@index/download',compact('data'));
        }
        else{
            return view("index@login/index",compact('id'));
        }
    }
}
