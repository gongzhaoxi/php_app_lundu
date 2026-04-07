<?php /*a:2:{s:71:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/system/clear/index.html";i:1755524162;s:66:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/common/layout.html";i:1764860923;}*/ ?>
<!DOCTYPE html>
<html lang="en" style="display: none;">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>后台管理系统</title>
    <link rel="stylesheet" href="/static/common/library/layui/css/layui.css">
    <link rel="stylesheet" href="/static/common/icons/iconfont.css">
    <link rel="stylesheet" href="/static/backend/css/theme.css">
    <link rel="stylesheet" href="/static/backend/css/app.css">
    
</head>
<body>
    
<div class="container">
    <div class="layui-card">
        <div class="layui-card-body layui-form">
            <div class="layui-form-item">
                <label class="layui-form-label"><span class="asterisk">*</span>数据缓存：</label>
                <div class="layui-input-block">
                    <input type="checkbox" name="type[]" value="1" title="系统缓存" lay-skin="primary">
                    <input type="checkbox" name="type[]" value="2" title="登录缓存" lay-skin="primary">
                    <input type="checkbox" name="type[]" value="3" title="模板缓存" lay-skin="primary">
                    <input type="checkbox" name="type[]" value="4" title="日志文件" lay-skin="primary">
                    <input type="checkbox" name="type[]" value="5" title="临时图片" lay-skin="primary">
                </div>
                <div class="layui-form-mid layui-word-aux" style="white-space:nowrap;">
                    注：清除缓存可能出现短暂的访问时间过长，建议在访问低峰期进行操作！
                </div>
            </div>

            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn layui-btn-sm layui-btn-default <?php echo check_perms('clean', false); ?>"
                            lay-submit lay-filter="addForm">
                        立即清理
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

    <script src="/static/common/library/layui/layui.js"></script>
    <script src="/static/common/library/jquery.min.js"></script>
    <script src="/static/common/library/cache.min.js"></script>
    <script src="/static/backend/js/sortable.min.js"></script>
    <script src="/static/backend/js/config.min.js"></script>
    <script src="/static/backend/js/utils.min.js"></script>
    
<script>
    layui.use(['form'], function() {
        let form = layui.form;

        form.on('submit(addForm)', function(data){
            layer.confirm('确定要清空选择的缓存吗？', function(index) {
                layer.close(index);
                waitUtil.ajax({
                    url: '<?php echo route("system.clear/clean"); ?>',
                    type: 'POST',
                    data: data.field
                });
            });
            return false;
        });
    });
</script>

</body>
</html>