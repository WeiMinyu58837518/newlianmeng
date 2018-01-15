<div class="page-toolbar">
        <div class="layui-btn-group fl">
            <a href="{:url('add')}" class="layui-btn layui-btn-primary"><i class="aicon ai-tianjia"></i>添加</a>
        </div>
    </div>
    <div class="layui-form">
        <table class="layui-table mt10" lay-even="" lay-skin="row">
            <colgroup>
                <col width="150">
                <col width="300">
                <col width="250">
                <col width="300">
            </colgroup>
            <thead>
            <tr>
                <th>id</th>
                <th>分类名称</th>
                <th>父类id</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>

            {volist name="type" id="vo"}
            <tr>
                <td>{$vo['id']}</td>
                <td>{$vo['level']}{$vo['name']}</td>
                <td>{$vo['pid']}</td>
<!--                <td>-->
<!---->
<!--                    <input type="checkbox" name="status" {if condition="$vo['status'] eq 1"}checked=""{/if} value="{$vo['status']}" lay-skin="switch" lay-filter="switchStatus" lay-text="正常|关闭" data-href="{:url('status?table=type&ids='.$vo['id'])}">-->
<!--                </td>-->
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
    $(".delete").click(function(){
        if(confirm('确定删除？')){
            var id=$(this).attr('idd');
            $.get('delete/id/'+id,function(a){
                if(a.info==10000){
                    layer.msg('删除成功');
                    location.reload();
                }
                if(a.info==20000){
                    layer.msg('删除失败');
                }
                if(a.info==30000){
                    layer.msg(a.error, {
                        offset: 't',
                        anim: 6
                    });
                }
            })
        }
    })
</script>

