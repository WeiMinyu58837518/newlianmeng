<?php
namespace app\shopback\home;
use app\common\controller\Common;
use think\Request;
use think\Db;
use think\Session;
class Index extends Common
{
    //显示登陆页面
    public function index()
    {
        return $this->fetch();
    }
    //登陆验证逻辑
    public function login(){
        $data=Request::instance()->param();
        $res=Db::name('merchant')->where('name',$data['name'])->find();
        if(!$res){
            return ['info'=>20000];
        }
        $realpassword=$res['password'];
        $ress=password_verify($data['password'], $realpassword);
        if(!$ress){
            return ['info'=>20000];
        }
        Session::set('user',$res['id']);
        return ['info'=>10000];
    }
}