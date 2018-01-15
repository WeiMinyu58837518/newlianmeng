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
{include file="theme/shopback/default/common/header.php" /}
<!-- 左 -->
{include file="theme/shopback/default/common/left.php" /}
<!-- 右 -->
<div class="content">
    <div class="header">
        <h1 class="page-title">管理员编辑</h1>
    </div>

    <div class="well">
        <!-- edit form -->
        <form action="{:url('shopback/edit/edit')}" method="post" id="tab" enctype="multipart/form-data">
            <label>商户名称：</label>
            <input type="text" name="name" value="{$data['name']}" class="input-xlarge">
            <label>地址：</label>
            <input type="text" name="address" value="{$data['address']}" class="input-xlarge">
            <label>电话：</label>
            <input type="text" name="phone" value="{$data['phone']}" class="input-xlarge">
            <label>邮箱：</label>
            <input type="text" name="email" value="{$data['email']}" class="input-xlarge">
            <label>logo：</label>
            <input type="file" name="logo" value="" class="input-xlarge">
            <img src="{$data['logo']}" alt="" width="20%">
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