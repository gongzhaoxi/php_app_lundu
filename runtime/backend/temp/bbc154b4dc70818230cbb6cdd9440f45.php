<?php /*a:2:{s:70:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/setting/sms/index.html";i:1755524162;s:66:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/common/layout.html";i:1764860923;}*/ ?>
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
    <!-- 表格栏 -->
    <div class="layui-card">
        <div class="layui-card-header">短信设置</div>
        <div class="layui-card-body wait-table-cell">
            <table id="wait-table-list" lay-filter="wait-table-list"></table>
            <script type="text/html" id="table-image">
                <img src="{{d.image}}" alt="图标" class="previewImage">
            </script>
            <script type="text/html" id="table-enable">
                {{#  if(d.enable === 1){ }}
                    <span class="color-success"><i class="layui-icon layui-icon-circle-dot" lay-tips="启用"></i></span>
                {{# } else { }}
                    <span class="color-error"><i class="layui-icon layui-icon-circle-dot" lay-tips="禁用"></i></span>
                {{#  } }}
            </script>
            <script type="text/html" id="table-operate">
                <button type="button" class="layui-btn layui-btn-default layui-btn-xs <?php echo check_perms('set'); ?>" lay-event="set">
                    <i class="layui-icon icon-setup-fill"></i>
                </button>
            </script>
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
    layui.use(function() {

        // 渲染表格
        let table = waitUtil.table({
            elem: '#wait-table-list'
            ,url: '<?php echo route("setting.sms/index"); ?>'
            ,toolbar: false
            ,page: false
            ,cols: [[
                {field:'image', title:'图标', align:'center', minWidth:150, templet:'#table-image'},
                {field:'name', title:'短信渠道', align:'center', minWidth:120},
                {field:'desc', title:'渠道描述', align:'center', minWidth:320},
                {field:'enable', title:'状态', align:'center', minWidth:70, templet:'#table-enable'},
                {fixed:'right', title:'操作', width:90, align:'center', toolbar:'#table-operate'}
            ]]
        });

        // 逻辑事件
        waitUtil.event({
            set: function (obj) {
                console.log(obj)
                waitUtil.popup({
                    title: '编辑',
                    url: '<?php echo route("setting.sms/save"); ?>?alias='+obj.data.alias,
                    area: ['500px', '430px'],
                    success: function (layero, index) {
                        layero.layui.form.on('submit(addForm)', function(data) {
                            waitUtil.locking(this);
                            data.field['alias'] = obj.data.alias;
                            waitUtil.ajax({
                                url: '<?php echo route("setting.sms/save"); ?>',
                                type: 'POST',
                                data: data.field
                            }).then((res) => {
                                waitUtil.unlock(this);
                                if (res.code === 0) {
                                    table.reload();
                                    layer.close(index);
                                }
                            }).catch(() => {
                                waitUtil.unlock(this);
                            });
                        });
                    }
                });
            }
        });
    });
</script>

</body>
</html>