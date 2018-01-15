<?php
/**
 * Created by PhpStorm.
 * User: XuGuanyu
 * Date: 2018/1/12
 * Time: 18:31
 */

namespace app\shopback\home;


use app\common\controller\Common;
use function password_verify;
use think\Db;
use think\Request;
use think\Session;

class User extends Common
{
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        //检测是否登陆
        if(!Session::get('user')){
            $this->error('没有登陆','shopback/index/index');
        }
    }
}