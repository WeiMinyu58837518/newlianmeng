<?php
/**
 * Created by PhpStorm.
 * User: XuGuanyu
 * Date: 2018/1/12
 * Time: 17:24
 */

namespace app\total\admin;
use think\Request;
use think\Db;
use think\Validate;

use app\admin\controller\Admin;

class Doghouse extends Admin
{
    //犬舍列表
    public function index(){
        if(Request::instance()->param('q')){
            $se='%';
            $se.=Request::instance()->param('q');
            $se.='%';
            $data=Db::name('doghouse')->where('title','like',$se)->order('id','desc')->select();
            if(empty($data)){
                $this->error('查无此文');
            }
            $this->assign('data',$data);
            $this->assign('list','');
            return $this->fetch();
        }else{
            $data=Db::name('doghouse')->order('id','desc')->paginate(1);
            $page=$data->render();
            $this->assign('data',$data);
            $this->assign('list',$page);
            return $this->fetch();
        }

    }
    public function add(){
        if(Request::instance()->isGet()){
            return $this->fetch();
        }
        if(Request::instance()->isPost()){
            $data=Request::instance()->param();
            $rules = [
                'title' => 'require',
                'author' => 'require',
                'img'=>'require',
                'content' => 'require'
            ];
            $msg = [
                'title.require'=>'文章标题不能为空',
                'author.require'=>'作者不能为空',
                'img.require'=>'请上传图片',
                'content.require'=>'正文不能为空'
            ];
            $validate = new Validate($rules, $msg);
            $res = $validate->check($data);
            if(!$res){
                $this->error($validate->getError());
            }
            //验证结束入库

            $id=Db::name('doghouse')->insertGetId(['title'=>$data['title'],'author'=>$data['author'],'img'=>$data['img'],'ctime'=>date('Y-m-d H:i:s',time()),'ptime'=>date('Y-m-d H:i:s',time())]);
            $res=Db::name('doghouse_content')->insert(['doghouse_id'=>$id,'content'=>$data['content']]);
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
            $data=Db::name('doghouse')->alias('d1')->where('id',$id)->join('lm_doghouse_content d2','d1.id=d2.doghouse_id','LEFT')->find();
            $this->assign('data',$data);
            return $this->fetch();
        }
        if(Request::instance()->isPost()){
            $data=Request::instance()->param();
            $rules = [
                'title' => 'require',
                'author' => 'require',
                'img'=>'require',
                'content' => 'require'
            ];
            $msg = [
                'title.require'=>'文章标题不能为空',
                'author.require'=>'作者不能为空',
                'img.require'=>'请上传图片',
                'content.require'=>'正文不能为空'
            ];
            $validate = new Validate($rules, $msg);
            $res = $validate->check($data);
            if(!$res){
                $this->error($validate->getError());
            }
            //验证结束入库
            $res1=Db::name('doghouse')->where('id',$data['idd'])->update(['title'=>$data['title'],'author'=>$data['author'],'img'=>$data['img'],'ptime'=>date('Y-m-d H:i:s',time())]);
            $res2=Db::name('doghouse_content')->where('doghouse_id',$data['idd'])->update(['content'=>$data['content']]);
            if($res1==true || $res2==true){
                $this->success('修改成功','index');
            }else{
                $this->error('修改失败');
            }
        }
    }
    public function delete(){
        $id=Request::instance()->param('id');
        $res=Db::name('doghouse')->where('id',$id)->delete();
        Db::name('doghouse_content')->where('doghouse_id',$id)->delete();
        if($res){
            return ['info'=>10000];
        }else{
            return ['info'=>20000];
        }
    }
    public function deleteall(){
        $ids=Request::instance()->param();
        $res=Db::name('doghouse')->delete($ids['delete']);
        Db::name('doghouse_content')->delete($ids['delete']);
//        foreach($ids['delete'] as $k=>$v){
//            Db::name('doghouse')->where('id',$v)->delete();
//            Db::name('doghouse_content')->where('doghouse_id',$v)->delete();
//        }
        if($res){
            $this->success('删除成功','index');
        }else{
            $this->error('删除失败');
        }

    }
}