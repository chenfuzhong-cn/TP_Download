<?php

namespace app\http\middleware;

class CheckLogin
{
    public function handle($request, \Closure $next,$arg)
    {
        if(!session('?username')){
            // return redirect(url('index/login/login'))->with('error','请登录');
            $id = 1;
            return view('index@login/index',compact('id'));
        }
        return $next($request);
    }
}
