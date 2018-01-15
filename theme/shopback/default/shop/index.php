<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>商户管理系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" type="text/css" href="/theme/shopback/default/static/css/main.css">
    <link rel="stylesheet" type="text/css" href="/theme/shopback/default/static/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/theme/shopback/default/static/css/bootstrap-responsive.min.css">
    <style type="text/css">
        table img{max-width: 100px;}
    </style>
</head>
<body>
<!-- 上 -->
{include file="theme/shopback/default/common/header.php" /}
<!-- 左 -->
{include file="theme/shopback/default/common/left.php" /}
<!-- 右 -->
<div class="content">
    <div class="header">
        <h1 class="page-title">商品列表</h1>
    </div>

    <div class="well">
        <!-- search button -->
        <form action="" method="get" class="form-search">
            <div class="row-fluid" style="text-align: left;">
                <div class="pull-left span4 unstyled">
                    <p> 商品名称：<input class="input-medium" name="" type="text" id="sear"></p>
                </div>
            </div>
            <button type="button" class="btn" id="search">查找</button>
            <a class="btn btn-primary" onclick="javascript:window.location.href='#'">新增</a>
        </form>
    </div>
    <div class="well">
        <!-- table -->
        <table class="table table-bordered table-hover table-condensed" id="myTable">
            <thead>
            <tr>
                <th>序号</th>
                <th>商品名称</th>
                <th>价格</th>
                <th>年龄</th>
                <th>性别</th>
                <th>颜色</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody id="tbody">
            {volist name='data' id='vo' key='ke'}
            <tr class="{$ke%2==0? 'info' : 'warning'}">
                <td>{$ke}</td>
                <td><a href="javascript:void(0);">{$vo['name']}</a></td>
                <td>{$vo['price']}</td>
                <td>{$vo['age']}</td>
                <td>{$vo['sex']}</td>
                <td>{$vo['color']}</td>
                <td>
                    <a href="javascript:void(0);" class="edit" idd="{$vo['id']}"> 编辑 </a>
                    <a href="javascript:void(0);" idd="{$vo['id']}" class="delete"> 删除 </a>
                </td>
            </tr>
            </tbody>
            {/volist}
        </table>
        <div class="pagination" id="pagee">
<!--            <ul>-->
<!--                <li><a href="#">Prev</a></li>-->
<!--                <li><a href="#">1</a></li>-->
<!--                <li><a href="#">2</a></li>-->
<!--                <li><a href="#">3</a></li>-->
<!--                <li><a href="#">4</a></li>-->
<!--                <li><a href="#">Next</a></li>-->
<!--            </ul>-->
            {$page}
        </div>
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
<!-- 日期控件 -->
<script src="/theme/shopback/default/static/js/calendar/WdatePicker.js"></script>
</html>
