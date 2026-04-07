<?php /*a:2:{s:73:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/system/dict/typeList.html";i:1755524162;s:66:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/common/layout.html";i:1764860923;}*/ ?>
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
    <!-- 搜索栏 -->
    <form class="layui-form layui-search">
        <div class="layui-form-item">
            <div class="layui-inline">
                <label for="name" class="layui-form-label">字典名称：</label>
                <div class="layui-input-inline">
                    <input type="text" id="name" name="name" class="layui-input" placeholder="请输入字典名称" autocomplete="off">
                </div>
            </div>
            <div class="layui-inline">
                <label for="type" class="layui-form-label">字典类型：</label>
                <div class="layui-input-inline">
                    <input type="text" id="type" name="type" class="layui-input" placeholder="请输入字典类型" autocomplete="off">
                </div>
            </div>
            <div class="layui-inline">
                <label for="is_enable" class="layui-form-label">字典状态：</label>
                <div class="layui-input-inline">
                    <select id="is_enable" name="is_enable">
                        <option value="" selected>全部</option>
                        <option value="1">正常</option>
                        <option value="0">停用</option>
                    </select>
                </div>
            </div>
            <div class="layui-inline layui-input-datetime">
                <label for="datetime" class="layui-form-label">创建时间：</label>
                <div class="layui-input-block">
                    <input type="text" id="datetime" name="datetime" class="layui-input" placeholder="开始日期 - 结束日期" readonly>
                </div>
            </div>
            <div class="layui-inline">
                <a class="layui-btn layui-btn-sm layui-btn-default" lay-submit lay-filter="search">查询</a>
                <a class="layui-btn layui-btn-sm layui-btn-primary" lay-submit lay-filter="clear-search">重置</a>
            </div>
        </div>
    </form>

    <!-- 表格栏 -->
    <div class="layui-card">
        <div class="layui-card-body">
            <table id="wait-table-list" lay-filter="wait-table-list"></table>
            <script type="text/html" id="toolbar">
                <div class="layui-btn-container">
                    <a class="layui-btn layui-btn-sm layui-btn-default <?php echo check_perms('add'); ?>" lay-event="add">
                        <i class="layui-icon icon-add"></i>
                        <span>新增</span>
                    </a>
                    <a class="layui-btn layui-btn-sm layui-btn-danger layui-btn-forbid <?php echo check_perms('del'); ?>" lay-event="leave">
                        <i class="layui-icon icon-del"></i>
                        <span>删除</span>
                    </a>
                </div>
            </script>
            <script type="text/html" id="table-status">
                {{#  if(d.is_enable === 1){ }}
                    <span class="color-success"><i class="layui-icon layui-icon-circle-dot" lay-tips="正常"></i></span>
                {{# } else { }}
                    <span class="color-warning"><i class="layui-icon layui-icon-circle-dot" lay-tips="停用"></i></span>
                {{#  } }}
            </script>
            <script type="text/html" id="table-operate">
                <button type="button" class="layui-btn layui-btn-xs layui-btn-gloomy <?php echo check_perms('data'); ?>" lay-event="data">
                    <i class="layui-icon icon-setup-fill"></i>
                </button>
                <button type="button" class="layui-btn layui-btn-xs layui-btn-default <?php echo check_perms('edit'); ?>" lay-event="edit">
                    <i class="layui-icon icon-edit"></i>
                </button>
                <button type="button" class="layui-btn layui-btn-xs layui-btn-danger <?php echo check_perms('stop'); ?>" lay-event="del">
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
    layui.use(['laydate'], function() {
        let laydate = layui.laydate;

        // 时间选择
        laydate.render({elem: '#datetime' ,type: 'datetime' ,trigger: 'click' ,range: true});

        // 渲染表格
        let table = waitUtil.table({
            elem: '#wait-table-list'
            ,url: '<?php echo route("system.dictType/index"); ?>'
            ,cols: [[
                {type:'checkbox', width:48},
                {field:'id', title:'ID', width:70, align:'center', event:'id'},
                {field:'name', title:'字典名称', minWidth:160},
                {field:'type', title:'字典类型', minWidth:160},
                {field:'remark', title:'备注信息', minWidth:150},
                {field:'status', title:'启用状态', minWidth:100, align:'center', templet:'#table-status'},
                {field:'create_time', title:'创建时间', minWidth:170, align:'center'},
                {fixed:'right', title:'操作', width:120, align:'center', toolbar:'#table-operate'}
            ]]
        });

        // 逻辑事件
        waitUtil.event({
            data: function (obj) {
                waitUtil.popup({
                    title: '字典数据: 【 ' + obj.data.name + " (" + obj.data.type + ") 】",
                    url: '<?php echo route("system.dictData/index"); ?>?type_id='+obj.data.id,
                    area: ['900px', '605px'],
                    success: function (layero, index) {}
                });
            },
            add: function () {
                waitUtil.popup({
                    title: '新增',
                    url: '<?php echo route("system.dictType/add"); ?>',
                    area: ['500px', '400px'],
                    success: function (layero, index) {
                        layero.layui.form.on('submit(addForm)', function(data) {
                            waitUtil.locking(this);
                            waitUtil.ajax({
                                url: '<?php echo route("system.dictType/add"); ?>',
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
            edit: function (obj) {
                waitUtil.popup({
                    title: '编辑',
                    url: '<?php echo route("system.dictType/edit"); ?>?id='+obj.data.id,
                    area: ['500px', '400px'],
                    success: function (layero, index) {
                        layero.layui.form.on('submit(addForm)', function(data) {
                            waitUtil.locking(this);
                            data.field['id'] = obj.data.id;
                            waitUtil.ajax({
                                url: '<?php echo route("system.dictType/edit"); ?>',
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
            del: function (obj) {
                layer.confirm('确定要删除此项数据吗？', function(index) {
                    layer.close(index);
                    waitUtil.ajax({
                        url: '<?php echo route("system.dictType/del"); ?>',
                        type: 'POST',
                        data: {ids: [obj.data.id]}
                    }).then((res) => {
                        if (res.code === 0) {
                            table.reload();
                        }
                    });
                });
            },
            leave: function () {
                let ids = waitUtil.checkbox();
                if (!ids.length) {
                    return layer.msg('请至少选择一项！', {icon: 2});
                }
                layer.confirm(`确定要删除选中的${ids.length}项数据吗？`, function(index) {
                    layer.close(index);
                    waitUtil.ajax({
                        url: '<?php echo route("system.dictType/del"); ?>',
                        type: 'POST',
                        data: {ids: ids}
                    }).then((res) => {
                        if (res.code === 0) {
                            table.reload();
                        }
                    });
                });
            }
        });

        // 搜索事件
        waitUtil.search(table);
    });
</script>

</body>
</html>