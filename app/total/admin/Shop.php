<?php
/**
 * Created by PhpStorm.
 * User: XuGuanyu
 * Date: 2018/1/15
 * Time: 12:02
 */

namespace app\total\admin;


use app\admin\controller\Admin;
use think\Db;
use think\Request;
use think\Validate;

class Shop extends Admin
{
    public function index(){
        if(Request::instance()->param('q')){
            $name=Request::instance()->param('q');
            $name='%'.$name.'%';
            $merchant=Db::name('merchant')->where('name','like',$name)->order('id','desc')->select();
            $this->assign('merchant',$merchant);
            $this->assign('page','');
            return $this->fetch();
        }else{
            $merchant=Db::name('merchant')->order('id','desc')->paginate(10);
            $page=$merchant->render();
            $this->assign('page',$page);
            $this->assign('merchant',$merchant);
            return $this->fetch();
        }
    }
    public function goods(){
        $id=Request::instance()->param('id');
        $data=Db::name('goods')->where('user_id',$id)->order('id','desc')->paginate(10);
        $page=$data->render();
        $this->assign('page',$page);
        $this->assign('data',$data);
        return $this->fetch();
    }
    public function edit(){
        if(Request::instance()->isGet()){
            $id=Request::instance()->param('id');
            $data=Db::name('goods')->where('id',$id)->find();
            $this->assign('data',$data);
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
            return $this->fetch();
        }
        if(Request::instance()->isPost()){
            $data=Request::instance()->param();
            $data['type_id']=$data['type_id']+0;
            $rules = [
                'type_id' => 'require',
                'name' => 'require',
                'price' => "require|number",
                'img' => 'require',
                'sex' => 'in:1,2',
                'age' => 'require',
                'color' => 'require',
                'intro' => 'require',
                'details' => 'require'
            ];
            $msg = [
                'type_id.require'=>'商品分类未选择',
                'name.require'=>'商品名称未写入',
                'price.require'=>'商品价格未填写',
                'price.number'=>'商品价格不合法',
                'img.require'=>'封面图未上传',
                'sex.in'=>'商品性别为选择',
                'age.require'=>'年龄未写入',
                'color.require'=>'颜色为写入',
                'intro.require'=>'简介为写入',
                'details.require'=>'商品详情未填写'

            ];
            $validate = new Validate($rules, $msg);
            $res = $validate->check($data);
            if(!$res){
                $this->error($validate->getError());
            }
            $res=Db::name('goods')->where('id',$data['id'])->update(['name'=>$data['name'],'intro'=>$data['intro'],'price'=>$data['price'],'age'=>$data['age'],'sex'=>$data['sex'],'color'=>$data['color'],'img'=>$data['img'],'type_id'=>$data['type_id'],'details'=>$data['details']]);
            if($res){
                $this->success('修改成功','index');
            }else{
                $this->error('修改失败');
            }
        }
    }
    public function delete(){
        $id=Request::instance()->param('id');
        $res=Db::name('goods')->where('id',$id)->delete();
        if($res){
            return ['info'=>10000];
        }else{
            return ['info'=>20000];
        }
    }
    //管理员后台商品添加
    public function myadd(){
        if(Request::instance()->isGet()){
            $type=Db::name('goods_type')->where('lev',2)->select();
            $this->assign('type',$type);
            return $this->fetch();
        }
        if(Request::instance()->isPost()){
            $data=Request::instance()->param();
            $data['type_id']=$data['type_id']+0;
            $data['user_id']=0;
            $rules = [
                'type_id' => 'require',
                'name' => 'require',
                'price' => "require|number",
                'img' => 'require',
                'sex' => 'in:1,2',
                'age' => 'require',
                'color' => 'require',
                'intro' => 'require',
                'details' => 'require'
            ];
            $msg = [
                'type_id.require'=>'商品分类未选择',
                'name.require'=>'商品名称未写入',
                'price.require'=>'商品价格未填写',
                'price.number'=>'商品价格不合法',
                'img.require'=>'封面图未上传',
                'sex.in'=>'商品性别为选择',
                'age.require'=>'年龄未写入',
                'color.require'=>'颜色为写入',
                'intro.require'=>'简介为写入',
                'details.require'=>'商品详情未填写'

            ];
            $validate = new Validate($rules, $msg);
            $res = $validate->check($data);
            if(!$res){
                $this->error($validate->getError());
            }
            $res=Db::name('goods')->insert($data);
            if($res){
                $this->success('商品添加成功');
            }else{
                $this->error('商品添加失败');
            }
        }
    }
    //管理员商品查看
    public function mygoods(){
        $data=Db::name('goods')->where('user_id',0)->paginate(10);
        $this->assign('data',$data);
        $page=$data->render();
        $this->assign('page',$page);
        return $this->fetch();
    }
}