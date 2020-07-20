<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Image;
use app\common\model\Files;

class Soft extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
      
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        return view('admin@soft/create');
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        
        // 获取表单上传
        $file = request()->file('pic');
        // 移动到框架应用根目录/img/ 目录下
        $info = $file->move( './static/img');
        // 成功上传后 获取上传信息
        if($info){
           $savename = '/static/img/'.str_replace('\\','/',$info->getSaveName()); // img 路径
           // 打开图片
           $image = Image::open(public_path().$savename); // public_path 是自定义函数，生成的public路径
           // 生成缩略图
           $image->thumb(285,250)->save(public_path().$savename);
          
           // 入库
           $data = $request->post();
           $data['imagesrc'] = $savename;
           Files::create($data);
           return redirect(url('/soft/create'))->with('success','添加成功');
        }
        else{
            return redirect(url('/soft/create'))->with('success','添加失败');
        }
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $res = Files::where('id',$id)->find();
        return view('admin@soft/edit',compact('res'));
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        
        if(request()->file()){
            // 获取表单上传
            $file = request()->file('pic');
            // 移动到框架应用根目录/img/ 目录下
            $info = $file->move( './static/img');
            // 删除原图片
            $data = Files::where('id',$id)->find();
            $img = str_replace('\\','/',public_path().$data['imagesrc']);
            if(file_exists($img)){
                unlink($img);
            }else{
                return redirect(url('/soft/'.$id.'/edit'))->with('success','删除原封面失败');
            }
            // 成功上传后 获取上传信息
            if($info){
                $savename = '/static/img/'.str_replace('\\','/',$info->getSaveName()); // img 路径
                // 打开图片
                $image = Image::open(public_path().$savename); // public_path 是自定义函数，生成的public路径
                // 生成缩略图
                $image->thumb(285,250)->save(public_path().$savename);
            
                // 更新数据库
                $data = $request->put();
                $data['imagesrc'] = $savename;
                unset($data['_method']);
                Files::where('id',$id)->update($data);
                return redirect(url('/soft/'.$id.'/edit'))->with('success','修改成功');
            }
            else{
                return redirect(url('/soft/'.$id.'/edit'))->with('success','修改失败');
            }
        }
        else{
            $data = $request->put();
            unset($data['_method']);
            Files::where('id',$id)->update($data);
            return redirect(url('/soft/'.$id.'/edit'))->with('success','修改成功');
        }

    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {   
        $data = Files::where('id',$id)->find();
        $img = str_replace('\\','/',public_path().$data['imagesrc']);

        if(file_exists($img)){
            unlink($img);
            Files::destroy($id);
            return json(['msg'=>'已删除']);
        }else{
            return json(['msg'=>'删除失败']);
        }

        
    }
}
