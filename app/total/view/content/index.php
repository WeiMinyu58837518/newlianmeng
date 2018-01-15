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
                        <input type="text" name="q" lay-verify="required" placeholder="请输入文章标题" autocomplete="off" class="layui-input">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="layui-form">
        <table class="layui-table mt10" lay-even="" lay-skin="row">
            <colgroup>
                <col width="50">
                <col width="250">
                <col width="100">
            </colgroup>
            <thead>
            <tr>
                <th>分类id</th>
                <th>分类名称</th>
                <th>父类id</th>
            </tr>
            </thead>
            <tbody>

            {volist name="data" id="vo"}
            <tr>
                <td>{$vo['id']}</td>
                <td><a href="{:url('/total/content/article/id/'.$vo['id'])}">{$vo['level']}{$vo['name']}</a></td>
                <td>{$vo['pid']}</td>
            </tr>
            {/volist}

            </tbody>
        </table>
    </div>
</form>

{include file="admin@block/layui" /}