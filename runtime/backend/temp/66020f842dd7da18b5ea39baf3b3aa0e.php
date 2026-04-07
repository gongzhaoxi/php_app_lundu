<?php /*a:2:{s:72:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/shipping_line/index.html";i:1763649858;s:66:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/common/layout.html";i:1764860923;}*/ ?>
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
                <label for="type" class="layui-form-label">进出类别：</label>
                <div class="layui-input-inline">
                    <select id="type" name="type">
                        <option value="" selected>全部</option>
						<?php foreach($type as $k=>$v): ?>
						<option value="<?php echo htmlentities((string) $k); ?>"><?php echo htmlentities((string) $v); ?></option>
						<?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="layui-inline">
                <label for="name" class="layui-form-label">航班名称：</label>
                <div class="layui-input-inline">
                    <input type="text" id="name" name="name"
                        class="layui-input" placeholder="请输入航班名称" autocomplete="off">
                </div>
            </div>
            <div class="layui-inline">
                <label for="is_show" class="layui-form-label">是否显示：</label>
                <div class="layui-input-inline">
                    <select id="is_show" name="is_show">
                        <option value="" selected>全部</option>
                        <option value="1">是</option>
                        <option value="0">否</option>
                    </select>
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
                </div>
            </script>
            <script type="text/html" id="table-is_show">
                {{#  if(d.is_show === 0){ }}
                    <span class="color-success"><i class="layui-icon layui-icon-circle-dot" lay-tips="正常"></i></span>
                {{# } else { }}
                    <span class="color-warning"><i class="layui-icon layui-icon-circle-dot" lay-tips="禁用"></i></span>
                {{#  } }}
            </script>
            <script type="text/html" id="table-is_delete">
                {{#  if(d.is_delete === 0){ }}
                    <span class="color-success"><i class="layui-icon layui-icon-circle-dot" lay-tips="正常"></i></span>
                {{# } else { }}
                    <span class="color-warning"><i class="layui-icon layui-icon-circle-dot" lay-tips="禁用"></i></span>
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
    layui.use(function() {
        // 渲染表格
        let table = waitUtil.table({
            elem: '#wait-table-list'
            ,url: '<?php echo route("ShippingLine/index"); ?>'
            ,cols: [[
                {field:'id', title:'ID', width:60, align:'center'},
				{field:'name', title:'航班名称', align:'center'},
                {field:'type_text', title:'进出类别', align:'center'},
                {field:'is_show', title:'是否显示', width:120, align:'center', templet:'#table-is_show'},
                {field:'create_time', title:'创建时间', width:160, align:'center'},
                {fixed:'right', title:'操作', width:90, align:'center', toolbar:'#table-operate'}
            ]]
        });
 

        // 逻辑事件
        waitUtil.event({
            add: function () {
                waitUtil.popup({
                    title: '新增',
                    url: '<?php echo route("ShippingLine/add"); ?>',
                    area: ['90%', '90%'],
                    success: function (layero, index) {
                        layero.layui.form.on('submit(addForm)', function(data) {
                            waitUtil.locking(this);
                            waitUtil.ajax({
                                url: '<?php echo route("ShippingLine/add"); ?>',
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
                    url: '<?php echo route("ShippingLine/edit"); ?>?id='+obj.data.id,
                    area: ['90%', '90%'],
                    success: function (layero, index) {
                        layero.layui.form.on('submit(addForm)', function(data) {
                            waitUtil.locking(this);
                            data.field['id'] = obj.data.id;
                            waitUtil.ajax({
                                url: '<?php echo route("ShippingLine/edit"); ?>',
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
                        url: '<?php echo route("ShippingLine/del"); ?>',
                        type: 'POST',
                        data: {id: obj.data.id}
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