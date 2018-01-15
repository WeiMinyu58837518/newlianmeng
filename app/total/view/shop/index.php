<form class="page-list-form">
    <div class="page-toolbar">
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
                <col width="50">
                <col width="450">
            </colgroup>
            <thead>
            <tr>
                <th>序号</th>
                <th>商户名称</th>
            </tr>
            </thead>
            <tbody>
            {volist name="merchant" id="vo" key='ke'}
            <tr>
                <td>{$ke}</td>
                <td><a href="{:url("/total/shop/goods/id/".$vo['id'])}">{$vo['name']}</a></td>
            </tr>
            {/volist}
            </tbody>
        </table>
    </div>
</form>
{$page}
{include file="admin@block/layui" /}

