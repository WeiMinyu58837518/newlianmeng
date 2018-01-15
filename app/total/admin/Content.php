<?php
/**
 * Created by PhpStorm.
 * User: XuGuanyu
 * Date: 2018/1/12
 * Time: 17:33
 */

namespace app\total\admin;


use app\admin\controller\Admin;
use function findFother;
use think\Db;
use think\Request;
use think\Validate;


class Content extends Admin
{
    public function index(){
        if(Request::instance()->param('q')){
            $se='%';
            $se.=Request::instance()->param('q');
            $se.='%';
            $data=Db::name('article')->where('title','like',$se)->select();
            if(empty($data)){
                $this->error('查无此文');
            }
            $this->assign('data',$data);
            return $this->fetch('allsearch');
        }else{
            $data=Db::name('type')->select();
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
    }


    //根据分类跳转到分类内容页
    //$list 层级关系
    public function article(){
        if(Request::instance()->param('q')){
            $se='%';
            $se.=Request::instance()->param('q');
            $se.='%';
            $id=Request::instance()->param('id');
            $data=Db::name('article')->where('type_id',$id)->where('title','like',$se)->select();
            if(empty($data)){
                $this->error('查无此文');
            }
            $type=Db::name('type')->select();
            foreach ($type as $k => $v){
                if($v['id']==$id){
                    $list=$v['name'];
                    $pid=$v['pid'];
                }
            }
            $list.=findFother($type, $pid);
            $this->assign('data',$data);
            $this->assign('list',$list);
            $this->assign('page','');
            return $this->fetch();
        }else{
            $id=Request::instance()->param('id');
            //获取此分类下的内容
            $data=Db::name('article')->where('type_id',$id)->select();
            if(empty($data)){
                $this->error('此分类下还没有内容','index');
            }
            $data=Db::name('article')->where('type_id',$id)->paginate(10);
            //获取此分类的名称与上级分类
            $type=Db::name('type')->select();
            foreach ($type as $k => $v){
                if($v['id']==$id){
                    $list=$v['name'];
                    $pid=$v['pid'];
                }
            }
            $list.=findFother($type, $pid);
            $this->assign('data',$data);
            $this->assign('list',$list);
            $this->assign('page',$data->render());
            return $this->fetch();
        }

    }



    //添加内容
    public function add(){
        if(Request::instance()->isGet()){
            $type=Db::name('type')->select();
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
            if($data['type_id']==0){
                $this->error('请选择内容分组');
            }
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
            //入库
            $id=Db::name('article')->insertGetId(['title'=>$data['title'],'author'=>$data['author'],'img'=>$data['img'],'type_id'=>$data['type_id'],'ctime'=>date('Y-m-d H:i:s',time()),'ptime'=>date('Y-m-d H:i:s',time())]);
            $res=Db::name('article_content')->insert(['article_id'=>$id,'content'=>$data['content']]);
            if($res){
                $this->success('添加成功','index');
            }else{
                $this->error('添加失败');
            }
        }
    }


    //修改内容
    public function edit(){
        if(Request::instance()->isGet()){
            $id=Request::instance()->param('id');
            $type=Db::name('type')->select();
            $type=getTree($type);
            foreach($type as &$v){
                $level='';
                for($i=0;$i<$v['level'];$i++){
                    $level.='--';
                }
                $v['level']=$level;
            }
            $this->assign('type',$type);
            $data=Db::name('article')->alias('a1')->join('lm_article_content a2','a1.id=a2.article_id')->where('a1.id',$id)->find();
            $this->assign('data',$data);
            return $this->fetch();
        }
        if(Request::instance()->isPost()){
            $data=Request::instance()->param();
            if($data['type_id']==0){
                $this->error('请选择内容分组');
            }
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
            //入库
            $res=Db::name('article')->where('id',$data['id'])->update(['title'=>$data['title'],'author'=>$data['author'],'img'=>$data['img'],'type_id'=>$data['type_id'],'ptime'=>date('Y-m-d H:i:s',time())]);
            $ress=Db::name('article_content')->where('article_id',$data['id'])->update(['content'=>$data['content']]);
            if($res==true || $ress==true){
                $this->success('修改成功','/admin.php/total/content/article/id/'.$data['type_id']);
            }else{
                $this->error('修改失败');
            }
        }

    }

    //删除内容
    public function delete(){
        $id=Request::instance()->param('id');
        $res=Db::name('article')->delete($id);
        Db::name('article_content')->delete($id);
        if($res){
            return ['info'=>10000];
        }else{
            return ['info'=>20000];
        }
    }

    public function deleteall(){
        $ids=Request::instance()->param();
        $res=Db::name('article')->delete($ids['delete']);
        Db::name('article_content')->delete($ids['delete']);
        if($res){
            $this->success('删除成功','index');
        }else{
            $this->error('删除失败');
        }
    }
}