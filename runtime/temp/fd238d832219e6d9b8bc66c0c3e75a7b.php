<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:38:"theme\shopback\default\index\index.php";i:1515755995;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>登录</title>
    <link rel="stylesheet" type="text/css" href="/theme/shopback/default/static/css/login.css">
    <style type="text/css">
        .login-bg{
            background: url(/theme/shopback/default/static/image/login-bg-8.jpg) no-repeat center center fixed;
            background-size: 100% 100%;
        }
    </style>
</head>

<body class="login-bg">
<div class="login-box">
    <header>
        <h1>商户管理系统</h1>
    </header>
    <div class="login-main">
        <form action="" class="form" method="post">
            <div class="form-item">
                <label class="login-icon">
                    <i></i>
                </label>
                <input type="text" id='username' name="name" placeholder="这里输入登录名" required>
            </div>
            <div class="form-item">
                <label class="login-icon">
                    <i></i>
                </label>
                <input type="password" id="password" name="password" placeholder="这里输入密码">
            </div>
            <div class="form-item">
                <button type="button" class="login-btn">
                    登&emsp;&emsp;录
                </button>
            </div>
        </form>
        <div class="msg"></div>
    </div>
</div>
<script type="text/javascript" src='/theme/shopback/default/static/js/jquery-3.1.1.min.js'></script>
<script type="text/javascript">
    $(function(){
        $('.login-btn').on('click',function(){
            if($('#username').val() == ''){
                $('.msg').html('登录名不能为空');
                return;
            }
            if($('#password').val() == ''){
                $('.msg').html('密码不能为空');
                return;
            }
            if($('#verify').val() == ''){
                $('.msg').html('验证码不能为空');
                return;
            }
            var data=$('form').serialize();
            $.post('<?php echo url("shopback/index/login"); ?>',data,function(a){
                if(a.info==20000){
                    $('.msg').html('用户名或密码错误');
                    return;
                }
                if(a.info==10000){
                    location.href='<?php echo url("shopback/shop/index"); ?>';
                }
            })
//            $('form').submit();

        });
    })
</script>
</body>
</html>
