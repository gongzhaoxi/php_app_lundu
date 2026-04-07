<?php /*a:2:{s:70:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/shipping_line/add.html";i:1763649844;s:66:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/common/layout.html";i:1755524162;}*/ ?>
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
        <!-- 进出类别 -->
        <div class="layui-form-item">
            <label for="type" class="layui-form-label"><span class="asterisk">*</span>进出类别：</label>
            <div class="layui-input-block">
                <select id="type" name="type" lay-verify="required">
					<?php foreach($type as $k=>$v): ?>
                    <option value="<?php echo htmlentities((string) $k); ?>"><?php echo htmlentities((string) $v); ?></option>
					<?php endforeach; ?>
                </select>
            </div>
        </div>
        <!-- 航班名称 -->
        <div class="layui-form-item">
            <label for="name" class="layui-form-label"><span class="asterisk">*</span>航班名称：</label>
            <div class="layui-input-block">
                <input type="text" id="name" name="name" autocomplete="off"
                    class="layui-input" lay-verType="tips" lay-verify="required">
            </div>
        </div>
        <!-- 是否显示 -->
        <div class="layui-form-item">
            <label class="layui-form-label"><span class="asterisk">*</span>是否显示：</label>
            <div class="layui-input-block">
                <input type="radio" name="is_show" value="1" title="是" <?php if(1==1): ?>checked<?php endif; ?>>
                <input type="radio" name="is_show" value="0" title="否" <?php if(2==1): ?>checked<?php endif; ?>>
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
    
</body>
</html>