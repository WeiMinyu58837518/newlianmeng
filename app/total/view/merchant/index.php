<form class="page-list-form">
    <div class="page-toolbar">
        <div class="layui-btn-group fl">
            <a href="{:url('add')}" class="layui-btn layui-btn-primary"><i class="aicon ai-tianjia"></i>添加</a>
        </div>
        <div class="page-filter fr">
            <form class="layui-form layui-form-pane" action="{:url()}" method="get">
                <div class="layui-form-item">
                    <label class="layui-form-label">搜索</label>
                    <div class="layui-input-inline">
                        <input type="text" name="q" lay-verify="required" placeholder="请输入关键词搜索" autocomplete="off" class="layui-input">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="layui-form">
        <table class="layui-table mt10" lay-even="" lay-skin="row">
            <colgroup>
                <col width="30">
                <col width="200">
                <col width="200">
                <col width="100">
                <col width="80">
                <col width="80">
                <col width="120">
            </colgroup>
            <thead>
            <tr>
                <th>序号</th>
                <th>商户名称</th>
                <th>地址</th>
                <th>电话</th>
                <th>邮箱</th>
                <th>所选模板</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>

            {volist name="data" id="vo" key='ke'}
            <tr>
                <td>{$ke}</td>
                <td>{$vo['name']}</td>
                <td>{$vo['address']}</td>
                <td>{$vo['phone']}</td>
                <td>{$vo['email']}</td>
                <td>{$vo['changemodel']}</td>
                <td>
                    <div class="layui-btn-group">
                        <div class="layui-btn-group">
                            <a href="{:url('edit?id='.$vo['id'])}" class="layui-btn layui-btn-primary layui-btn-small"><i class="layui-icon"></i></a>
                            <a href="#" class="layui-btn layui-btn-primary layui-btn-small delete" idd="{$vo['id']}"><i class="layui-icon"></i></a>
                        </div>
                    </div>
                </td>
            </tr>
            {/volist}
            </tbody>
        </table>
    </div>
</form>
{$page}
{include file="admin@block/layui" /}
<script src="/static/js/jquery.js"></script>
<script>
    $('.delete').click(function(){
        if(confirm('确定删除')){
            var id=$(this).attr('idd');
            var data={
                id:id
            };
            $.post('{:url("/total/merchant/delete")}',data,function(a){
                if(a.info==10000){
                    layer.msg('删除成功');
                    location.reload();
                }
                if(a.info==20000){
                    layer.msg('删除失败');
                }
            })
        }

    })
</script>

