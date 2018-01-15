<form class="page-list-form">
    <div class="page-toolbar">
        <div class="layui-btn-group fl">
            <a href="{:url('add')}" class="layui-btn layui-btn-primary"><i class="aicon ai-tianjia"></i>添加</a>
        </div>
    </div>
    <div class="layui-form">
        <table class="layui-table mt10" lay-even="" lay-skin="row">
            <colgroup>
                <col width="50">
                <col width="250">
                <col width="200">
            </colgroup>
            <thead>
            <tr>
                <th>序号</th>
                <th>比赛种类</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            {volist name="data" id="vo" key='ke'}
            <tr>
                <td>{$ke}</td>
                <td>{$vo['name']}</td>
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

{include file="admin@block/layui" /}
<script src="/static/js/jquery.js"></script>
<script>
    $('.delete').click(function(){
        if(confirm('确定删除')){
            var id=$(this).attr('idd');
            $.get('delete/id/'+id,function(a){
                if(a.info==10000){
                    layer.msg('删除成功')
                    location.href='index'
                }
                if(a.info==20000){
                    layer.msg('删除失败')
                }
            })
        }

    })
</script>