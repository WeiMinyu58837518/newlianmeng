<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:37:"theme\shopback\default\edit\index.php";i:1515772327;s:40:"theme/shopback/default/common/header.php";i:1515769925;s:38:"theme/shopback/default/common/left.php";i:1515824282;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>后台管理系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" type="text/css" href="/theme/shopback/default/static/css/main.css">
    <link rel="stylesheet" type="text/css" href="/theme/shopback/default/static/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/theme/shopback/default/static/css/bootstrap-responsive.min.css">
</head>
<body>
<!-- 上 -->
<div class="navbar">
    <div class="navbar-inner">
        <div class="container-fluid">
            <ul class="nav pull-right">
                <li id="fat-menu" class="dropdown">
                    <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-user icon-white"></i> admin
                        <i class="icon-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a tabindex="-1" href="javascript:void(0);">修改密码</a></li>
                        <li class="divider"></li>
                        <li><a tabindex="-1" href="javascript:void(0);">安全退出</a></li>
                    </ul>
                </li>
            </ul>
            <a class="brand" href="index.html"><span class="first">商户管理系统</span></a>
            <ul class="nav">
<!--                <li class="active"><a href="javascript:void(0);">首页</a></li>-->
            </ul>
        </div>
    </div>
</div>
<!-- 左 -->
<div class="sidebar-nav">
    <a href="#accounts-menu" class="nav-header" data-toggle="collapse"><i class="icon-exclamation-sign"></i>商品管理</a>
    <ul id="accounts-menu" class="nav nav-list collapse">
        <li><a href="javascript:void(0);">商品列表</a></li>
        <li><a href="javascript:void(0);">商品分类</a></li>
    </ul>
    <a href="#yonghu-menu" class="nav-header" data-toggle="collapse"><i class="icon-exclamation-sign"></i>商户管理</a>
    <ul id="yonghu-menu" class="nav nav-list collapse">
        <li><a href="<?php echo url('shopback/edit/index'); ?>">商户信息修改</a></li>
    </ul>
</div>
<!-- 右 -->
<div class="content">
    <div class="header">
        <h1 class="page-title">管理员编辑</h1>
    </div>

    <div class="well">
        <!-- edit form -->
        <form action="<?php echo url('shopback/edit/edit'); ?>" method="post" id="tab" enctype="multipart/form-data">
            <label>商户名称：</label>
            <input type="text" name="name" value="<?php echo $data['name']; ?>" class="input-xlarge">
            <label>地址：</label>
            <input type="text" name="address" value="<?php echo $data['address']; ?>" class="input-xlarge">
            <label>电话：</label>
            <input type="text" name="phone" value="<?php echo $data['phone']; ?>" class="input-xlarge">
            <label>邮箱：</label>
            <input type="text" name="email" value="<?php echo $data['email']; ?>" class="input-xlarge">
            <label>logo：</label>
            <input type="file" name="logo" value="<?php echo $data['logo']; ?>" class="input-xlarge">
            <img src="<?php echo $data['logo']; ?>" alt="" width="20%">
            <label>模板样式：</label>
            <select name="changemodel" class="input-xlarge">
                <option value="0">请选择模板</option>
                <option value="1">手机</option>
            </select>
            <br>
            <button class="btn btn-primary" type="submit" >保存</button>
        </form>
    </div>
    <!-- footer -->
    <footer>
        <hr>
        <p>© 2017 <a href="javascript:void(0);" target="_blank">ADMIN</a></p>
    </footer>
</div>
</body>
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="/theme/shopback/default/static/js/jquery-1.8.1.min.js"></script>
<script src="/theme/shopback/default/static/js/bootstrap.min.js"></script>
</html>