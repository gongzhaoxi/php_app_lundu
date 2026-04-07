<?php /*a:2:{s:68:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/auth/menu/index.html";i:1755524162;s:66:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/common/layout.html";i:1764860923;}*/ ?>
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
        <!-- 表格栏 -->
        <div class="layui-card-body">
            <table id="wait-table-list" lay-filter="wait-table-list"></table>
            <script type="text/html" id="toolbar">
                <div class="layui-btn-container">
                    <a class="layui-btn layui-btn-sm layui-btn-default <?php echo check_perms('add'); ?>" lay-event="add">
                        <i class="layui-icon icon-add"></i>
                        <span>新增</span>
                    </a>
                    <button class="layui-btn layui-btn-sm layui-btn-primary" lay-event="expand">展开所有</button>
                    <button class="layui-btn layui-btn-sm layui-btn-primary" lay-event="collapse">收起所有</button>
                </div>
            </script>
            <script type="text/html" id="table-icon">
                <i class="layui-icon {{d.icon}}"></i>
            </script>
            <script type="text/html" id="table-menu">
                {{#  if(d.is_menu === 0){ }}
                    <span class="color-error"><i class="layui-icon layui-icon-circle-dot" lay-tips="否"></i></span>
                {{# } else { }}
                    <span class="color-success"><i class="layui-icon layui-icon-circle-dot" lay-tips="是"></i></span>
                {{#  } }}
            </script>
            <script type="text/html" id="table-operate">
                <button type="button" class="layui-btn layui-btn-xs layui-btn-default <?php echo check_perms('edit'); ?>" lay-event="edit">
                    <i class="layui-icon icon-edit"></i>
                </button>
                <button type="button" class="layui-btn layui-btn-xs layui-btn-danger <?php echo check_perms('del'); ?>" lay-event="del">
                    <i class="layui-icon icon-del"></i>
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
    layui.use(['treeTable'], function () {
        let treeTable = layui.treeTable;

        // 渲染表格
        let table = layui.treeTable.render({
            tree: {
                customName: {
                    children: 'children'
                    ,name: 'title'
                    ,pid: 'pid'
                    ,id: 'id'
                }
                ,view: {
                    showIcon: false
                    ,showFlexIconIfNotParent: false
                }
                ,data: {
                    rootPid: 0
                    ,isSimpleData: true
                }
            }
            ,id: 'wait-table-list'
            ,elem: '#wait-table-list'
            ,url: '<?php echo route("auth.menu/index"); ?>'
            ,toolbar: '#toolbar'
            ,defaultToolbar: ['filter', 'exports', 'print']
            ,skin: 'line'
            ,cols: [[
                {field:'title', title:'标题', minWidth:200},
                {field:'icon', title:'图标', minWidth:60, align:'center', templet:'#table-icon'},
                {field:'perms', title:'权限', minWidth:250},
                {field:'sort', title:'排序', minWidth:80, align:'center'},
                {field:'is_menu', title:'菜单', minWidth:60, align:'center', templet:'#table-menu'},
                {field:'right', title:'操作', width:90, align:'center', toolbar:'#table-operate'},
            ]]
        });

        // 逻辑事件
        waitUtil.event({
            add: function () {
                waitUtil.popup({
                    title: '新增',
                    url: '<?php echo route("auth.menu/add"); ?>',
                    area: ['500px', '500px'],
                    success: function (layero, index) {
                        layero.layui.form.on('submit(addForm)', function(data) {
                            waitUtil.locking(this);
                            waitUtil.ajax({
                                url: '<?php echo route("auth.menu/add"); ?>',
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
            },
            edit: function (obj) {
                waitUtil.popup({
                    title: '编辑',
                    url: '<?php echo route("auth.menu/edit"); ?>?id='+obj.data.id,
                    area: ['500px', '500px'],
                    success: function (layero, index) {
                        layero.layui.form.on('submit(addForm)', function(data) {
                            waitUtil.locking(this);
                            data.field['id'] = obj.data.id;
                            waitUtil.ajax({
                                url: '<?php echo route("auth.menu/edit"); ?>',
                                type: 'POST',
                                data: data.field
                            }).then((res) => {
                                waitUtil.unlock(this);
                                if (res.code === 0) {
                                    table.reload({page: {curr: 1}});
                                    layer.close(index);
                                }
                            }).catch(() => {
                                waitUtil.unlock(this);
                            });
                        });
                    }
                });
            },
            del: function (obj) {
                layer.confirm('确定要删除此项数据吗？', function(index) {
                    layer.close(index);
                    waitUtil.ajax({
                        url: '<?php echo route("auth.menu/del"); ?>',
                        type: 'POST',
                        data: {id: obj.data.id}
                    }).then((res) => {
                        if (res.code === 0) {
                            table.reload();
                            layer.msg(res.msg, {icon: 1, time: 1000});
                        }
                    });
                });
            },
            expand: function () {
                treeTable.expandAll('wait-table-list', true)
            },
            collapse: function () {
                treeTable.expandAll('wait-table-list', false)
            }
        });
    });
</script>

</body>
</html>