<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\validate\LoginValidate;
use app\common\model\User;

class Login extends Controller
{
    // 登录视图
    public function login(){
        $id = 0;
        return view("index@login/index",compact('id'));
    }

    // 登录验证
    public function loginSave(Request $request){
        // 用验证器验证验证码
        $res = $this->validate($request->post(),LoginValidate::class); // 返回 true or false
        if(true !== $res){
           return $this->error($res);
        }

        $arr = $request->except(['__token__','vcode']); // 获取除了__token__,vcode 之外的值
        $u = $arr['username'];
        $p = $arr['password'];

        if(User::where('username','=',$u)->where('password','=',$p)->find()){
            session('username',$u);
            $id = input('id');
            if($id == 0){
                return $this->success('登录成功！',url('index'),'',2);
            }
            else if($id == 1){
                if(session('username')=='root'){
                    return $this->success('登录成功！',url('admin/index/index'),'',2);
                }
                else{
                    return $this->success('登录成功！',url('index'),'',2);
                }
                
            }
            else{
                return $this->success('登录成功！', url('download')."?id=$id", '', 2);
            }
             
        }else{
            return $this->error('账号或密码错误',url('login'),'',2);
        }
    }

    // 退出
    public function logout(){
        // 删除session
        session('username',null);
        // 清除session
        session(null);
        $id = 0;
        return view('index@login/index',compact('id'));
    }
}
