<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\common\model\Files;

class Index extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        if (session('username')!=='root') {
            return $this->redirect(url('index'));
        }
        return view('admin@/index/index');
    }

    // 无刷新分页
    public function adminAjax(Request $request)
    {
        $data = Files::paginate(8);
        $page = $data->render();
        $all = [$data,$page];
        echo json_encode($all);
    }

}