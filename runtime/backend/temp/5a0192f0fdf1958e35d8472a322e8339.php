<?php /*a:2:{s:73:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/setting/notice/index.html";i:1755524162;s:66:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/common/layout.html";i:1764860923;}*/ ?>
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
        <div class="layui-card-header">通知设置</div>
        <div class="layui-card-body wait-table-cell">
            <table id="wait-table-list" lay-filter="wait-table-list"></table>
            <script type="text/html" id="table-sysStatus">
                {{#  if(d.sysStatus === 1){ }}
                    <span class="color-success"><i class="layui-icon layui-icon-circle-dot" lay-tips="正常"></i></span>
                {{# } else { }}
                    <span class="color-warning"><i class="layui-icon layui-icon-circle-dot" lay-tips="禁用"></i></span>
                {{#  } }}
            </script>
            <script type="text/html" id="table-emsStatus">
                {{#  if(d.emsStatus === 1){ }}
                    <span class="color-success"><i class="layui-icon layui-icon-circle-dot" lay-tips="正常"></i></span>
                {{# } else { }}
                    <span class="color-warning"><i class="layui-icon layui-icon-circle-dot" lay-tips="禁用"></i></span>
                {{#  } }}
            </script>
            <script type="text/html" id="table-smsStatus">
                {{#  if(d.smsStatus === 1){ }}
                    <span class="color-success"><i class="layui-icon layui-icon-circle-dot" lay-tips="正常"></i></span>
                {{# } else { }}
                    <span class="color-warning"><i class="layui-icon layui-icon-circle-dot" lay-tips="禁用"></i></span>
                {{#  } }}
            </script>
            <script type="text/html" id="table-operate">
                <button type="button" class="layui-btn layui-btn-xs layui-btn-default <?php echo check_perms('edit'); ?>" lay-event="edit">
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
            ,url: '<?php echo route("setting.notice/index"); ?>'
            ,toolbar: false
            ,cols: [[
                {field:'id', title:'ID', width:70, align:'center', event:'id'},
                {field:'name', title:'通知场景', minWidth:170, align:'left'},
                {field:'scene', title:'场景编号', minWidth:90, align:'center'},
                {field:'type', title:'通知类型', minWidth:90, align:'center'},
                {field:'sysStatus', title:'系统', minWidth:60, align:'center', templet:'#table-sysStatus'},
                {field:'emsStatus', title:'邮件', minWidth:60, align:'center', templet:'#table-emsStatus'},
                {field:'smsStatus', title:'短信', minWidth:60, align:'center', templet:'#table-smsStatus'},
                {fixed:'right', title:'操作', width:70, align:'center', toolbar:'#table-operate'}
            ]]
        });

        // 逻辑事件
        waitUtil.event({
            edit: function (obj) {
                waitUtil.popup({
                    title: '编辑',
                    url: '<?php echo route("setting.notice/edit"); ?>?id='+obj.data.id,
                    area: ['500px', '550px'],
                    success: function (layero, index) {
                        layero.layui.form.on('submit(addForm)', function(data) {
                            waitUtil.locking(this);
                            data.field['id'] = obj.data.id;
                            waitUtil.ajax({
                                url: '<?php echo route("setting.notice/edit"); ?>',
                                type: 'POST',
                                data: data.field
                            }).then((res) => {
                                waitUtil.locking(this);
                                if (res.code === 0) {
                                    table.reload();
                                    layer.close(index);
                                }
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