<?php /*a:2:{s:66:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/auth/role/add.html";i:1755524162;s:66:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/common/layout.html";i:1764860923;}*/ ?>
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
    
<form class="layui-form">
    <!-- 主体内容 -->
    <div class="wait-body-content">
        <!-- 角色名称 -->
        <div class="layui-form-item">
            <label for="name" class="layui-form-label"><span class="asterisk">*</span>角色名称：</label>
            <div class="layui-input-block">
                <input type="text" id="name" name="name"
                       class="layui-input" autocomplete="off" lay-verType="tips" lay-verify="required">
            </div>
        </div>
        <!-- 角色排序 -->
        <div class="layui-form-item">
            <label for="sort" class="layui-form-label">角色排序：</label>
            <div class="layui-input-block">
                <input type="number" id="sort" name="sort"
                       class="layui-input" autocomplete="off" lay-verType="tips"
                       oninput="value=value.replace(/[^\d]/g,'').substring(0, 5)">
            </div>
        </div>
        <!-- 角色描述 -->
        <div class="layui-form-item">
            <label for="describe" class="layui-form-label">角色描述：</label>
            <div class="layui-input-block">
                <input type="text" id="describe" name="describe"
                       class="layui-input" autocomplete="off" lay-verType="tips">
            </div>
        </div>
        <!-- 角色状态 -->
        <div class="layui-form-item">
            <label class="layui-form-label">角色状态：</label>
            <div class="layui-input-block">
                <input type="radio" name="is_disable" value="0" title="正常" checked>
                <input type="radio" name="is_disable" value="1" title="禁用">
            </div>
        </div>
        <!-- 权限列表 -->
        <div class="layui-form-item">
            <label class="layui-form-label">权限列表：</label>
            <div class="layui-input-block">
                <div id="treeMenu"></div>
            </div>
        </div>
    </div>

    <!-- 提交按钮 -->
    <div class="wait-body-footer">
        <a class="layui-layer-btn0" lay-submit lay-filter="addForm">确定</a>
        <a class="layui-layer-btn1" id="closePopupWindow">取消</a>
    </div>
</form>

    <script src="/static/common/library/layui/layui.js"></script>
    <script src="/static/common/library/jquery.min.js"></script>
    <script src="/static/common/library/cache.min.js"></script>
    <script src="/static/backend/js/sortable.min.js"></script>
    <script src="/static/backend/js/config.min.js"></script>
    <script src="/static/backend/js/utils.min.js"></script>
    
<script>
    layui.use(['tree'], function () {
        let tree = layui.tree;

        // 权限树渲染
        tree.render({
            id: 'treeMenu'
            ,elem: '#treeMenu'
            ,data: JSON.parse('<?php echo $treeMenu; ?>')
            ,showCheckbox: true
            ,isJump: true
        });

    });
</script>

</body>
</html>