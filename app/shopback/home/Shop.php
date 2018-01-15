<?php
/**
 * Created by PhpStorm.
 * User: XuGuanyu
 * Date: 2018/1/12
 * Time: 19:17
 */

namespace app\shopback\home;


use function str_replace;
use think\Db;
use think\Request;
use think\Session;

class Shop extends User
{
    public function index(){
        $user=Session::get('user');
        //->where('user_id',$user)
        $data=Db::name('goods')->paginate(10);
        $page=$data->render();
        $page=str_replace('<li class="disabled"><span>', '<li class="active"><a>', $page);
        $page=str_replace('</span></li>', '</a></li>', $page);
        $page=str_replace('<li class="active"><span>', '<li class="active"><a>', $page);
        $this->assign('data',$data);
        $this->assign('page',$page);
        return $this->fetch();
    }
    public function edit(){
        $id=Request::instance()->param('id');
        $id=$id+0;
        $data=Db::name('goods')->where('id',$id)->find();
        if(empty($data)){
            $this->error('没有这件商品');
        }
        $this->assign('data',$data);
        return $this->fetch();
    }
    public function search(){
        $search=Request::instance()->param('se');
        $search='%'.$search.'%';
        $data=Db::name('goods')->where('name','like',$search)->select();
        if(empty($data)){
            return ['info'=>20000];
        }

        return ['info'=>10000,'data'=>$data];
    }
}