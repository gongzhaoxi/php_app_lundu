<?php /*a:2:{s:67:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/auth/menu/edit.html";i:1755524162;s:66:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/common/layout.html";i:1755524162;}*/ ?>
<!DOCTYPE html>
<html lang="en" style="display: none;">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WaitAdmin后台管理系统</title>
    <link rel="stylesheet" href="/static/common/library/layui/css/layui.css">
    <link rel="stylesheet" href="/static/common/icons/iconfont.css">
    <link rel="stylesheet" href="/static/backend/css/theme.css">
    <link rel="stylesheet" href="/static/backend/css/app.css">
    
</head>
<body>
    
<form class="layui-form">
    <!-- 主体内容 -->
    <div class="wait-body-content">
        <!-- 上级菜单 -->
        <div class="layui-form-item">
            <label for="pid" class="layui-form-label">上级菜单：</label>
            <div class="layui-input-block">
                <select id="pid" name="pid" lay-verify="required|number" lay-search>
                    <option value="0">顶级</option>
                    <?php if(is_array($menus) || $menus instanceof \think\Collection || $menus instanceof \think\Paginator): $i = 0; $__LIST__ = $menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['id'] == $detail['pid']): ?>
                            <option value="<?php echo htmlentities((string) $vo['id']); ?>" selected><?php echo htmlentities((string) $vo['html']); ?> <?php echo htmlentities((string) $vo['title']); ?></option>
                        <?php else: ?>
                            <option value="<?php echo htmlentities((string) $vo['id']); ?>"><?php echo htmlentities((string) $vo['html']); ?> <?php echo htmlentities((string) $vo['title']); ?></option>
                        <?php endif; ?>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
        <!-- 菜单图标 -->
        <div class="layui-form-item">
            <label for="iconPicker" class="layui-form-label">菜单图标：</label>
            <div class="layui-input-block">
                <input type="hidden" id="iconPicker" lay-filter="iconPicker">
                <input type="hidden" name="icon" value="<?php echo htmlentities((string) $detail['icon']); ?>">
            </div>
        </div>
        <!-- 菜单名称 -->
        <div class="layui-form-item">
            <label for="title" class="layui-form-label">菜单名称：</label>
            <div class="layui-input-block">
                <input type="text" id="title" name="title" value="<?php echo htmlentities((string) $detail['title']); ?>"
                       class="layui-input" autocomplete="off" lay-verify="required">
            </div>
        </div>
        <!-- 权限标识 -->
        <div class="layui-form-item">
            <label for="perms" class="layui-form-label">权限标识：</label>
            <div class="layui-input-block">
                <input type="text" id="perms" name="perms" value="<?php echo htmlentities((string) $detail['perms']); ?>"
                       class="layui-input" autocomplete="off">
            </div>
        </div>
        <!-- 菜单排序 -->
        <div class="layui-form-item">
            <label for="sort" class="layui-form-label">菜单排序：</label>
            <div class="layui-input-block">
                <input type="text" id="sort" name="sort" value="<?php echo htmlentities((string) $detail['sort']); ?>"
                       class="layui-input" autocomplete="off" lay-verify="required|number"
                       oninput="value=value.replace(/[^\d]/g,'').substring(0, 5)">
            </div>
        </div>
        <!-- 是否菜单 -->
        <div class="layui-form-item">
            <label class="layui-form-label">是否菜单：</label>
            <div class="layui-input-block">
                <input type="radio" name="is_menu" value="1" title="是" <?php if($detail['is_menu']==1): ?>checked<?php endif; ?>>
                <input type="radio" name="is_menu" value="0" title="否" <?php if($detail['is_menu']==0): ?>checked<?php endif; ?>>
            </div>
        </div>
        <!-- 是否禁用 -->
        <div class="layui-form-item">
            <label class="layui-form-label">是否禁用：</label>
            <div class="layui-input-block">
                <input type="radio" name="is_disable" value="1" title="是" <?php if($detail['is_disable']==1): ?>checked<?php endif; ?>>
                <input type="radio" name="is_disable" value="0" title="否" <?php if($detail['is_disable']==0): ?>checked<?php endif; ?>>
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
    layui.use(['iconPicker'], function () {
        let $ = layui.$;
        let iconPicker = layui.iconPicker;

        // 图标选择器
        iconPicker.render({
            elem: '#iconPicker',
            search: true,
            page: true,
            limit: 12,
            cellWidth: '20%',
            click: function (data) {
                $('input[name="icon"]').val(data.icon);
            }
        });
        iconPicker.checkIcon('iconPicker', "<?php echo htmlentities((string) (isset($detail['icon']) && ($detail['icon'] !== '')?$detail['icon']:'layui-icon layui-icon-circle-dot')); ?>");
    });
</script>

</body>
</html>