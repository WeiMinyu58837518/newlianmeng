<form class="layui-form layui-form-pane" action="{:url('')}" id="editForm" method="post">
    <fieldset class="layui-elem-field layui-field-title">
        <legend>商品信息修改</legend>
    </fieldset>
    <div class="layui-form-item">
        <label class="layui-form-label">分类</label>
        <div class="layui-input-inline">
            <select name="type_id" class="field-role_id" type="select">
                <option value="0">请选择分类</option>
                {volist name='type' id='ty'}
                <option value="{$ty['id']}" {$data['type_id']==$ty['id'] ? "selected=''" : ''}>{$ty['level']}{$ty['type']}</option>
                {/volist}
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">商品名称</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-username" name="name" value="{$data['name']}" lay-verify="title" autocomplete="off" placeholder="请输入商品名称">
        </div>
        <div class="layui-form-mid layui-word-aux"></div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">价格</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-username" name="price" value="{$data['price']}" lay-verify="title" autocomplete="off" placeholder="请输入商品价格">
        </div>
    </div>
    <!--图片-->
    <div class="layui-form-item">
        <label class="layui-form-label">封面图</label>
        <div class="layui-input-inline upload">
            <button type="button" name="upload" class="layui-btn layui-btn-primary layui-upload" lay-type="image" lay-data="{accept:'image'}">请上传图片</button>
            <input type="hidden" class="upload-input" name="img" value="{$data['img']}">
            <img src="{$data['img']}" style="border-radius:5px;border:1px solid #ccc" width="36" height="36">
        </div>
        <div class="layui-form-mid layui-word-aux"></div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">性别</label>
        <div class="layui-input-inline">
            <select name="sex" class="field-role_id" type="select">
                <option value="1" {$data['sex']==1 ? "selected" : ''}>公</option>
                <option value="2">母</option>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">年龄</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-username" name="age" value="{$data['age']}" lay-verify="title" autocomplete="off" placeholder="请输入年龄">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">颜色</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-email" name="color" value="{$data['color']}" lay-verify="title" autocomplete="off" placeholder="请输入颜色">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">简介</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-email" name="intro" value="{$data['intro']}" lay-verify="title" autocomplete="off" placeholder="请输入简介">
        </div>
    </div>
    <input type="hidden" name="id" class="" value="{$data['id']}">
    <div class="layui-form-item">
        <label class="layui-form-label">简介</label>
        <div class="layui-input-block">
            <textarea id="UEditor2" name="details">{$data['details']}</textarea>
    </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button type="submit" class="layui-btn" lay-submit="" lay-filter="formSubmit">提交</button>
            <a href="{:url('index')}" class="layui-btn layui-btn-primary ml10"><i class="aicon ai-fanhui"></i>返回</a>
        </div>
    </div>
</form>
{include file="admin@block/layui" /}

<script>
    /* 修改模式下需要将数据放入此变量 */
    var formData = {:json_encode($data_info)};
    // 会员选择回调函数
    function func(data) {
        var $ = layui.jquery;
        $('input[name="member"]').val('['+data[0]['id']+']'+data[0]['username']);
    }
    layui.use(['upload'], function() {
        var $ = layui.jquery, layer = layui.layer, upload = layui.upload;
        /**
         * 附件上传url参数说明
         * @param string $from 来源
         * @param string $group 附件分组,默认sys[系统]，模块格式：m_模块名，插件：p_插件名
         * @param string $water 水印，参数为空默认调用系统配置，no直接关闭水印，image 图片水印，text文字水印
         * @param string $thumb 缩略图，参数为空默认调用系统配置，no直接关闭缩略图，如需生成 500x500 的缩略图，则 500x500多个规格请用";"隔开
         * @param string $thumb_type 缩略图方式
         * @param string $input 文件表单字段名
         */
        upload.render({
            elem: '.layui-upload'
            ,url: '{:url("admin/annex/upload?water=no&thumb=no&from=input&group=sys")}'
            ,method: 'post'
            ,before: function(input) {
                layer.msg('文件上传中...', {time:3000000});
            },done: function(res, index, upload) {
                var obj = this.item;
                if (res.code == 0) {
                    layer.msg(res.msg);
                    return false;
                }
                layer.closeAll();
                var input = $(obj).parents('.upload').find('.upload-input');
                if ($(obj).attr('lay-type') == 'image') {
                    input.siblings('img').attr('src', res.data.file).show();
                }
                input.val(res.data.file);
            }
        });
    });
</script>

<!--
/**
 * editor 富文本编辑器
 * @param array $obj 编辑器的容器ID
 * @param string $name [为了方便大家能在系统设置里面灵活选择编辑器，建议不要指定此参数]，目前支持的编辑器[ueditor,umeditor,ckeditor,kindeditor]
 * @param string $upload [选填]附件上传地址
 */
-->
{:editor(['UMeditor1', 'UMeditor2'])}
{:editor(['kindeditor1', 'kindeditor2'], 'kindeditor')}
{:editor(['UEditor1', 'UEditor2'], 'ueditor')}
{:editor(['ckeditor', 'ckeditor2'], 'ckeditor')}
<script src="/static/admin/js/footer.js"></script>

