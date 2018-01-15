<form class="page-list-form">
    <div class="page-toolbar">
        <div class="layui-btn-group fl">

            <a href="{:url('add')}" class="layui-btn layui-btn-primary"><i class="aicon ai-tianjia"></i>添加</a>
            <a href="{:url('deleteall')}" class="layui-btn layui-btn-primary j-page-btns confirm"><i class="aicon ai-jinyong"></i>删除</a>

        </div>
        <div class="page-filter fr">
            <form class="layui-form layui-form-pane" action="{:url('')}" method="get">
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
                <col width="50">
                <col width="50">
                <col width="200">
                <col width="100">
                <col width="100">
                <col width="100">
                <col width="80">
            </colgroup>
            <thead>
            <tr>
                <th><input type="checkbox" lay-skin="primary" lay-filter="allChoose"></th>
                <th>序号</th>
                <th>标题</th>
                <th>作者</th>
                <th>创建时间</th>
                <th>修改时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>

            {volist name="data" id="vo" key='ke'}
            <tr>
                <td><input type="checkbox" class="layui-checkbox checkbox-ids" name="ids[]" value="{$vo['id']}" lay-skin="primary"></td>
                <td>{$ke}</td>
                <td>{$vo['title']}</td>
                <td>{$vo['author']}</td>
                <td>{$vo['ctime']}</td>
                <td>{$vo['ptime']}</td>
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
{$list}
{include file="admin@block/layui" /}
<script src="/static/js/jquery.js"></script>
<script>
    $(".delete").click(function(){
        if(confirm('是否确认？')){
            var id=$(this).attr('idd');
            $.get('delete/id/'+id,function (a) {
                if(a.info==10000){
                    layer.msg('删除成功')
                    location.href='index';
                }
                if(a.info==20000){
                    layer.msg('删除失败')
                }
            })
        }
    })
</script>