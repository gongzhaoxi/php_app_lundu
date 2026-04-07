<?php /*a:2:{s:63:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/device/add.html";i:1763651294;s:66:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/common/layout.html";i:1764860923;}*/ ?>
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
        <!-- 进出类别 -->
        <div class="layui-form-item">
            <label for="type" class="layui-form-label"><span class="asterisk">*</span>进出类别：</label>
            <div class="layui-input-block">
                <select id="type" name="type" lay-verify="required">
                    <option value="">请选择</option>
					<?php foreach($type as $k=>$v): ?>
                    <option value="<?php echo htmlentities((string) $k); ?>"><?php echo htmlentities((string) $v); ?></option>
					<?php endforeach; ?>
                </select>
            </div>
        </div>
        <!-- 识别类型 -->
        <div class="layui-form-item">
            <label for="category" class="layui-form-label"><span class="asterisk">*</span>识别类型：</label>
            <div class="layui-input-block">
                <select id="category" name="category" lay-verify="required">
                    <option value="">请选择</option>
					<?php foreach($category as $k=>$v): ?>
                    <option value="<?php echo htmlentities((string) $k); ?>"><?php echo htmlentities((string) $v); ?></option>
					<?php endforeach; ?>
                </select>
            </div>
        </div>
        <!-- 设备ID -->
        <div class="layui-form-item">
            <label for="sn" class="layui-form-label"><span class="asterisk">*</span>设备ID：</label>
            <div class="layui-input-block">
                <input type="text" id="sn" name="sn" autocomplete="off"
                    class="layui-input" lay-verType="tips" lay-verify="required">
            </div>
        </div>
        <!-- 是否显示: [0=否, 1=是] -->
        <div class="layui-form-item">
            <label class="layui-form-label"><span class="asterisk">*</span>是否显示:</label>
            <div class="layui-input-block">
                <input type="radio" name="is_show" value="1" title="是" checked>
                <input type="radio" name="is_show" value="0" title="否" >
            </div>
        </div>
        <!-- 备注 -->
        <div class="layui-form-item">
            <label for="remark" class="layui-form-label">备注：</label>
            <div class="layui-input-block">
                <input type="text" id="remark" name="remark" autocomplete="off"
                    class="layui-input" lay-verType="tips">
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