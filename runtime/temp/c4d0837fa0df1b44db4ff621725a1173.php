<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:49:"D:\Aliases\lianmeng/app/admin\view\member\pop.php";i:1515659782;s:50:"D:\Aliases\lianmeng\app\admin\view\block\layui.php";i:1515659782;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $_admin_menu_current['title']; ?>-后台首页</title>
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <link rel="stylesheet" href="/static/admin/js/layui/css/layui.css">
    <link rel="stylesheet" href="/static/admin/css/style.css?v=<?php echo time(); ?>">
</head>
<body class="pb50">
<div class="page-filter fr">
    <form class="layui-form layui-form-pane" action="<?php echo url(); ?>" method="get">
    <div class="layui-form-item">
        <label class="layui-form-label">搜索</label>
        <div class="layui-input-inline">
            <input type="text" name="q" value="<?php echo input('get.q'); ?>" lay-verify="required" placeholder="用户名、邮箱、手机、昵称" autocomplete="off" class="layui-input">
            <input type="hidden" name="func" value="<?php echo $callback; ?>">
        </div>
    </div>
    </form>
</div>
<form class="page-list-form">
    <div class="layui-form">
        <table class="layui-table mt10" lay-even="" lay-skin="row">
            <colgroup>
                <col width="50">
            </colgroup>
            <thead>
                <tr>
                    <th><input type="checkbox" lay-skin="primary" lay-filter="allChoose"></th>
                    <th>用户名</th>
                    <th>等级</th>
                    <th>昵称</th>
                    <th>手机</th>
                    <th>邮箱</th>
                    <th>状态</th>
                </tr> 
            </thead>
            <tbody>
                <?php 
                    $level = config('hs_system.member_level');
                 if(is_array($data_list) || $data_list instanceof \think\Collection || $data_list instanceof \think\Paginator): $i = 0; $__LIST__ = $data_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td><input type="checkbox" name="ids[]" class="layui-checkbox checkbox-ids" value="<?php echo $vo['id']; ?>" lay-skin="primary" data-json='<?php echo json_encode($vo, 1); ?>'></td>
                    <td><?php echo $vo['username']; ?></td>
                    <td><?php echo $level[$vo['level_id']]['name']; ?></td>
                    <td><?php echo $vo['nick']; ?></td>
                    <td><?php echo $vo['mobile']; ?></td>
                    <td><?php echo $vo['email']; ?></td>
                    <td><input type="checkbox" name="status" disabled="" <?php if($vo['status'] == 1): ?>checked=""<?php endif; ?> value="<?php echo $vo['status']; ?>" lay-skin="switch" lay-filter="switchStatus" lay-text="正常|关闭"></td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
    </div>
</form>
<div class="pop-bottom-bar">
    <div class="fl pages"><?php echo str_replace('&raquo;', '下一页', str_replace('&laquo;', '上一页', $pages)); ?></div>
    <div class="fr btns">
        <a class="layui-btn mr10" id="popConfirm">确定</a>
        <a class="layui-btn layui-btn-primary" onclick="parent.layer.closeAll();">关闭</a>
    </div>
</div>
<script src="/static/admin/js/layui/layui.js?v=<?php echo config('hisiphp.version'); ?>"></script>
<script>
    var ADMIN_PATH = "<?php echo $_SERVER['SCRIPT_NAME']; ?>", LAYUI_OFFSET = 0;
    layui.config({
        base: '/static/admin/js/',
        version: '<?php echo config("hisiphp.version"); ?>'
    }).use('global');
</script>
<script>
layui.use(['jquery'], function(){
    var $ = layui.jquery;
    $('#popConfirm').click(function() {
        var data = new Array(), json = '';
        if ($('input[name="ids[]"]:checked').length <= 0) {
            layui.layer.msg('请选择数据！');
            return false;
        }

        $('input[name="ids[]"]:checked').each(function(i) {
            json = eval('(' + $(this).attr('data-json') + ')');
            data[i] = json;
        });
        // 触发父级页面函数
        parent.<?php echo $callback; ?>(data);
        parent.layer.closeAll();
    });
});
</script>
</body>
</html>