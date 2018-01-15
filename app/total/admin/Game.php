<?php
/**
 * Created by PhpStorm.
 * User: XuGuanyu
 * Date: 2018/1/12
 * Time: 17:29
 */

namespace app\total\admin;


use app\admin\controller\Admin;
use think\Db;
use think\Request;
use think\Validate;

class Game extends Admin
{
    public function index(){
        $data=Db::name('gametype')->order('id','asc')->select();
        $this->assign('data',$data);
        return $this->fetch();
    }
    public function add(){
        if(Request::instance()->isGet()){
            return $this->fetch();
        }
        if(Request::instance()->isPost()){
            $data=Request::instance()->param();
            $rules = [
                'name' => 'require',
                'content' => 'require'
            ];
            $msg = [
                'name.require'=>'比赛名称不能为空',
                'content.require'=>'正文不能为空'
            ];
            $validate=new Validate($rules,$msg);
            $res=$validate->check($data);
            if(!$res){
                $this->error($validate->getError());
            }
            $id=Db::name('gametype')->insertGetId(['name'=>$data['name']]);
            $res=Db::name('game')->insert(['type_id'=>$id,'content'=>$data['content']]);
            if($res){
                $this->success('添加成功','index');
            }else{
                $this->error('添加失败');
            }
        }
    }
    public function edit(){
        if(Request::instance()->isGet()){
            $id=Request::instance()->param('id');
            $data=Db::name('gametype')->alias('g1')->where('id',$id)->join('lm_game g2','g1.id=g2.type_id','LEFT')->find();
            $this->assign('data',$data);
            return $this->fetch();
        }
        if(Request::instance()->isPost()){
            $data=Request::instance()->param();
            $rules = [
                'name' => 'require',
                'content' => 'require'
            ];
            $msg = [
                'name.require'=>'比赛名称不能为空',
                'content.require'=>'正文不能为空'
            ];
            $validate=new Validate($rules,$msg);
            $res=$validate->check($data);
            if(!$res){
                $this->error($validate->getError());
            }
            //完成入库
            $res1=Db::name('gametype')->where('id',$data['id'])->update(['name'=>$data['name']]);
            $res2=Db::name('game')->where('type_id',$data['id'])->update(['content'=>$data['content']]);
            if($res1 || $res2){
                $this->success('修改成功','index');
            }else{
                $this->error('修改失败');
            }
        }
    }
    public function delete(){
        $id=Request::instance()->param('id');
        $res=Db::name('gametype')->where('id',$id)->delete();
        Db::name('game')->where('type_id',$id)->delete();
        if($res){
            return ['info'=>10000];
        }else{
            return ['info'=>20000];
        }

    }
}