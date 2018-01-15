<?php
/**
 * Created by PhpStorm.
 * User: XuGuanyu
 * Date: 2018/1/12
 * Time: 16:48
 */

namespace app\total\admin;
use app\admin\controller\Admin;
use think\Db;
use think\Request;


class Type extends Admin
{
    //列表
    public function index(){
        $type=Db::name('type')->select();
        $type=getTree($type);
        foreach($type as &$v){
            $level='';
            for($i=0;$i<$v['level'];$i++){
                $level.='&nbsp;--';
            }
            $v['level']=$level;
        }
        $this->assign('type',$type);
        return $this->fetch();
    }
    //分类添加
    public function add(){
        if(Request::instance()->isGet()){
            $type=Db::name('type')->where('pid',0)->select();
            $type=getTree($type);
            foreach($type as &$v){
                $level='';
                for($i=0;$i<$v['level'];$i++){
                    $level.='--';
                }
                $v['level']=$level;
            }
            $this->assign('type',$type);
            return $this->fetch();
        }
        if(Request::instance()->isPost()){
            $data=Request::instance()->param();
            $data['status']=1;
            $res=Db::name('type')->insert($data);
            if($res){
                $this->success('添加成功');
            }else{
                $this->error('添加失败');
            }
        }

    }
    //分类编辑
    public function edit(){
        if(Request::instance()->isGet()){
            $id=Request::instance()->param('id');
            $data=Db::name('type')->where('id',$id)->find();
            $type=Db::name('type')->where('pid',0)->select();
            $type=getTree($type);
            foreach($type as &$v){
                $level='';
                for($i=0;$i<$v['level'];$i++){
                    $level.='--';
                }
                $v['level']=$level;
            }
            $this->assign('type',$type);
            $this->assign('data',$data);
            return $this->fetch();
        }
        if(Request::instance()->isPost()){
            $id=Request::instance()->param('idd');
            $data['pid']=Request::instance()->param('pid');
            $data['status']=Request::instance()->param('status');
            $data['name']=Request::instance()->param('name');
            $res=Db::name('type')->where('id',$id)->update($data);
            if($res){
                $this->success('修改成功','index');
            }else{
                $this->error('修改失败');
            }
        }
    }
    //删除分类
    public function delete(){
        $id=Request::instance()->param('id');
        $res=Db::name('type')->where('pid',$id)->select();
        if(!empty($res)){
            return ['info'=>30000,'error'=>'此分类有子分类，请勿删除'];
        }
        $ress=Db::name('type')->delete($id);
//        Db::name('article')->alias('a1')->join('lm_article_content a2','a1.id=a2.article_id')->where('a1.type_id',$id)->delete();
        if($ress){
            return ['info'=>10000];
        }else{
            return ['info'=>20000];
        }
    }
}