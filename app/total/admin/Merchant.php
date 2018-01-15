<?php
/**
 * Created by PhpStorm.
 * User: XuGuanyu
 * Date: 2018/1/12
 * Time: 17:53
 */

namespace app\total\admin;


use app\admin\controller\Admin;
use think\Db;
use think\Request;
use think\Validate;

class Merchant extends Admin
{
    public function index(){
        $data=Db::name('merchant')->paginate(10);
        $this->assign('data',$data);
        $page=$data->render();
        $this->assign('page',$page);
        return $this->fetch();
    }

    public function add(){
        if(Request::instance()->isGet()){
            return $this->fetch();
        }
        if(Request::instance()->isPost()){
            $data=Request::instance()->param();
            if(strlen($data['phone'])!=11){
                $this->error('电话不合法');
            }
            $rules = [
                'name' => 'require',
                'address' => 'require',
                'phone' => "number",
                'email' => 'require|email',
                'logo' => 'require',
                'zhanghu' => 'require|max:20',
                'password' => 'require|max:20|min:6'
            ];
            $msg = [
                'name.require'=>'商户名不能为空',
                'address.require'=>'地址不能为空',
                'phone.number'=>'电话不合法',
                'email.require'=>'邮箱不能为空',
                'email.email'=>'邮箱不合法',
                'logo.require'=>'logo未上传',
                'zhanghu.require'=>'账户名不能为空',
                'zhanghu.max'=>'账户名太长',
                'password.require'=>'密码不能为空',
                'password.max'=>'密码太长',
                'password.min'=>'密码至少为6位'
            ];
            $validate = new Validate($rules, $msg);
            $res = $validate->check($data);
            if(!$res){
                $this->error($validate->getError());
            }
            //入库
            $res=Db::name('merchant')->insert(['name'=>$data['name'],'address'=>$data['address'],'phone'=>$data['phone'],'email'=>$data['email'],'logo'=>$data['logo'],'zhanghu'=>$data['zhanghu'],'password'=>password_hash($data['password'], PASSWORD_DEFAULT)]);
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
            $data=Db::name('merchant')->where('id',$id)->find();
            $this->assign('data',$data);
            return $this->fetch();
        }
        if(Request::instance()->isPost()){
            $data=Request::instance()->param();
            //判断是否有修改密码
            if(empty($data['password'])){
                if(strlen($data['phone'])!=11){
                    $this->error('电话不合法');
                }
                $rules = [
                    'name' => 'require',
                    'address' => 'require',
                    'phone' => "number",
                    'email' => 'require|email',
                    'logo' => 'require',
                    'zhanghu' => 'require|max:20'
                ];
                $msg = [
                    'name.require'=>'商户名不能为空',
                    'address.require'=>'地址不能为空',
                    'phone.number'=>'电话不合法',
                    'email.require'=>'邮箱不能为空',
                    'email.email'=>'邮箱不合法',
                    'logo.require'=>'logo未上传',
                    'zhanghu.require'=>'账户名不能为空',
                    'zhanghu.max'=>'账户名太长'
                ];
                $validate = new Validate($rules, $msg);
                $res = $validate->check($data);
                if(!$res){
                    $this->error($validate->getError());
                }
                $res=Db::name('merchant')->where('id',$data['id'])->update(['name'=>$data['name'],'address'=>$data['address'],'phone'=>$data['phone'],'email'=>$data['email'],'logo'=>$data['logo'],'zhanghu'=>$data['zhanghu']]);
            }else{
                if(strlen($data['phone'])!=11){
                    $this->error('电话不合法');
                }
                $rules = [
                    'name' => 'require',
                    'address' => 'require',
                    'phone' => "number",
                    'email' => 'require|email',
                    'logo' => 'require',
                    'zhanghu' => 'require|max:20',
                    'password' => 'require|max:20|min:6'
                ];
                $msg = [
                    'name.require'=>'商户名不能为空',
                    'address.require'=>'地址不能为空',
                    'phone.number'=>'电话不合法',
                    'email.require'=>'邮箱不能为空',
                    'email.email'=>'邮箱不合法',
                    'logo.require'=>'logo未上传',
                    'zhanghu.require'=>'账户名不能为空',
                    'zhanghu.max'=>'账户名太长',
                    'password.require'=>'密码不能为空',
                    'password.max'=>'密码太长',
                    'password.min'=>'密码至少为6位'
                ];
                $validate = new Validate($rules, $msg);
                $res = $validate->check($data);
                if(!$res){
                    $this->error($validate->getError());
                }
                $res=Db::name('merchant')->where('id',$data['id'])->update(['name'=>$data['name'],'address'=>$data['address'],'phone'=>$data['phone'],'email'=>$data['email'],'logo'=>$data['logo'],'zhanghu'=>$data['zhanghu'],'password'=>password_hash($data['password'], PASSWORD_DEFAULT)]);
            }
            if($res){
                $this->success('修改成功','index');
            }else{
                $this->error('修改失败');
            }
        }
    }
    public function delete(){
        $id=Request::instance()->param('id');
        $res=Db::name('merchant')->delete($id);
        if($res){
            return ['info'=>10000];
        }else{
            return ['info'=>20000];
        }
    }
}