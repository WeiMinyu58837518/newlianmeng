<?php
/**
 * Created by PhpStorm.
 * User: XuGuanyu
 * Date: 2018/1/12
 * Time: 23:18
 */

namespace app\shopback\home;


use think\Db;
use think\Request;
use think\Session;

class Edit extends User
{
    public function index(){
        $data=Db::name('merchant')->where('id',Session::get('user'))->find();
        $this->assign('data',$data);
        return $this->fetch();
    }
    public function edit(){
        $data=Request::instance()->param();
        $img=request()->file('logo');
        $imgs=$img->move('C:/123');
        echo '<pre>';
        echo $imgs->getSaveName();
        echo "<hr>";
        print_r($img);
        print_r($data);
    }
}