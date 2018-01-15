<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:37:"theme\shopback\default\shop\index.php";i:1515986520;s:40:"theme/shopback/default/common/header.php";i:1515769925;s:38:"theme/shopback/default/common/left.php";i:1515824282;}*/ ?>
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
            <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $ke = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($ke % 2 );++$ke;?>
            <tr class="<?php echo $ke%2==0?'info' : 'warning'; ?>">
                <td><?php echo $ke; ?></td>
                <td><a href="javascript:void(0);"><?php echo $vo['name']; ?></a></td>
                <td><?php echo $vo['price']; ?></td>
                <td><?php echo $vo['age']; ?></td>
                <td><?php echo $vo['sex']; ?></td>
                <td><?php echo $vo['color']; ?></td>
                <td>
                    <a href="javascript:void(0);" class="edit" idd="<?php echo $vo['id']; ?>"> 编辑 </a>
                    <a href="javascript:void(0);" idd="<?php echo $vo['id']; ?>" class="delete"> 删除 </a>
                </td>
            </tr>
            </tbody>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
         pagination
        <div class="pagination" id="pagee">
<!--            <ul>-->
<!--                <li><a href="#">Prev</a></li>-->
<!--                <li><a href="#">1</a></li>-->
<!--                <li><a href="#">2</a></li>-->
<!--                <li><a href="#">3</a></li>-->
<!--                <li><a href="#">4</a></li>-->
<!--                <li><a href="#">Next</a></li>-->
<!--            </ul>-->
            <?php echo $page; ?>
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
<script>
    $('#search').click(function(){
        var search=$('#sear').val();
        var data={
            se:search
        }
        $.post('<?php echo url("shopback/shop/search"); ?>',data,function(a){
            if(a.info==20000){
                alert('没有这件商品');
            }
            if(a.info==10000){
                var data=a.data;
                var temp='';
                $.each(data,function(key,value){
                    console.log(value);
                    temp+='<tr class="';
                    if(key%2==0){
                        temp+='"info"';
                    }else{
                        temp+='"warning"';
                    }
                    temp+='><td>';
                    temp+=key+1;
                    temp+='</td><td><a href="javascript:void(0);">';
                    temp+=value.name;
                    temp+='</a></td><td>';
                    temp+=value.price;
                    temp+='</td><td>';
                    temp+=value.age;
                    temp+='</td><td>';
                    temp+=value.sex;
                    temp+='</td><td>';
                    temp+=value.color;
                    temp+='</td><td><a href="javascript:void(0);" class="edit" idd=';
                    temp+='"value.id"';
                    temp+='> 编辑 </a><a href="javascript:void(0);" idd=';
                    temp+='"value.id"';
                    temp+=' class="delete"> 删除 </a></td></tr>';
                });
                $('#tbody').html(temp);
                $('#pagee').html('');
            }
        })
    })
</script>
