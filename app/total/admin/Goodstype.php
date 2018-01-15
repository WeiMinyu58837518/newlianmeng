<?php
/**
 * Created by PhpStorm.
 * User: XuGuanyu
 * Date: 2018/1/15
 * Time: 14:22
 */

namespace app\total\admin;


use app\admin\controller\Admin;
use function getTree;
use think\Db;
use think\Request;
use think\Validate;

class goodstype extends Admin
{
    public function index(){
        $data=Db::name('goods_type')->select();
        $data=getTree($data);
        foreach($data as &$v){
            $level='';
            for($i=0;$i<$v['level'];$i++){
                $level.='&nbsp;--';
            }
            $v['level']=$level;
        }
        $this->assign('data',$data);
        return $this->fetch();
    }
    public function add(){
        if(Request::instance()->isGet()){
            $data=Db::name('goods_type')->where('lev','<=',1)->select();
            $data=getTree($data);
            foreach($data as &$v){
                $level='';
                for($i=0;$i<$v['level'];$i++){
                    $level.='&nbsp;--';
                }
                $v['level']=$level;
            }
            $this->assign('data',$data);
            return $this->fetch();
        }
        if(Request::instance()->isPost()){
            $data=Request::instance()->param();
            $data['pid']=$data['pid']+0;
            if($data['pid']!=0){
                $lev=Db::name('goods_type')->where('id',$data['pid'])->find();
                $lev=$lev['lev']+1;
            }else{
                $lev=0;
            }
            if($lev>2){
                $this->error('分类等级不正确');
            }
            $rules = [
                'type' => 'require'
            ];
            $msg = [
                'type.require'=>'分类名不能为空',
            ];
            $validate = new Validate($rules, $msg);
            $res = $validate->check($data);
            if(!$res){
                $this->error($validate->getError());
            }
            $res=Db::name('goods_type')->insert(['type'=>$data['type'],'pid'=>$data['pid'],'lev'=>$lev]);
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
            $data=Db::name('goods_type')->where('id',$id)->find();
            $type=Db::name('goods_type')->select();
            $type=getTree($type);
            foreach($type as &$v){
                $level='';
                for($i=0;$i<$v['level'];$i++){
                    $level.='&nbsp;--';
                }
                $v['level']=$level;
            }
            $this->assign('type',$type);
            $this->assign('data',$data);
            return $this->fetch();
        }
        if(Request::instance()->isPost()){
            $data=Request::instance()->param();
            $data['id']=$data['id']+0;
            $data['pid']=$data['pid']+0;
            if($data['pid']!=0){
                $lev=Db::name('goods_type')->where('id',$data['pid'])->find();
                $lev=$lev['lev']+1;
            }else{
                $lev=0;
            }
            if($lev>2){
                $this->error('分类等级不正确');
            }
            $rules = [
                'type' => 'require'
            ];
            $msg = [
                'type.require'=>'分类名不能为空',
            ];
            $validate = new Validate($rules, $msg);
            $res = $validate->check($data);
            if(!$res){
                $this->error($validate->getError());
            }
            $res=Db::name('goods_type')->where('id',$data['id'])->update(['type'=>$data['type'],'pid'=>$data['pid'],'lev'=>$lev]);
            if($res){
                $this->success('修改成功','index');
            }else{
                $this->error('修改失败');
            }
        }
    }
    public function delete(){
        $id=Request::instance()->param('id');
        $temp=Db::name('goods_type')->where('pid',$id)->select();
        if(!empty($temp)){
            return ['info'=>30000];
        }
        $res=Db::name('goods_type')->where('id',$id)->delete();
        if($res){
            return ['info'=>10000];
        }else{
            return ['info'=>20000];
        }
    }
}