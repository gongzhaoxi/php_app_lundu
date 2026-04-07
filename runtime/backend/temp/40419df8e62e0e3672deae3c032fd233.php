<?php /*a:2:{s:72:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/system/crontab/edit.html";i:1755524162;s:66:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/common/layout.html";i:1764860923;}*/ ?>
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
        <!-- 任务名称 -->
        <div class="layui-form-item">
            <label for="name" class="layui-form-label"><span class="asterisk">*</span>任务名称：</label>
            <div class="layui-input-block">
                <input type="text" id="name" name="name" value="<?php echo htmlentities((string) $detail['name']); ?>"
                       placeholder="请输入计划任务名称" class="layui-input"
                       autocomplete="off" lay-verType="tips" lay-verify="required">
            </div>
        </div>
        <!-- 执行命令 -->
        <div class="layui-form-item">
            <label for="command" class="layui-form-label"><span class="asterisk">*</span>执行命令：</label>
            <div class="layui-input-block">
                <input type="text" id="command" name="command" value="<?php echo htmlentities((string) $detail['command']); ?>"
                       placeholder="请输入执行的命令" class="layui-input"
                       autocomplete="off" lay-verType="tips" lay-verify="required">
            </div>
        </div>
        <!-- 附带参数 -->
        <div class="layui-form-item">
            <label for="params" class="layui-form-label">附带参数：</label>
            <div class="layui-input-block">
                <input type="text" id="params" name="params" value="<?php echo htmlentities((string) $detail['params']); ?>"
                       placeholder="请输入参数，例:--id 8 --name 测试" class="layui-input" autocomplete="off">
            </div>
        </div>
        <!-- 执行规则 -->
        <div class="layui-form-item">
            <label for="rules" class="layui-form-label">执行规则：</label>
            <div class="layui-input-block">
                <input type="text" id="rules" name="rules" value="<?php echo htmlentities((string) $detail['rules']); ?>"
                       placeholder="请输入crontab规则，例：59 * * * *" class="layui-input" autocomplete="off">
            </div>
        </div>
        <!-- 备注信息 -->
        <div class="layui-form-item">
            <label for="remarks" class="layui-form-label">备注信息：</label>
            <div class="layui-input-block">
                    <textarea id="remarks" name="remarks"
                              placeholder="请输入内容" class="layui-textarea"><?php echo htmlentities((string) $detail['remarks']); ?></textarea>
            </div>
        </div>
        <!-- 运行状态 -->
        <div class="layui-form-item">
            <label class="layui-form-label">运行状态：</label>
            <div class="layui-input-block">
                <input type="radio" name="status" value="1" title="立即启动" <?php if($detail['status']==1): ?>checked<?php endif; ?>>
                <input type="radio" name="status" value="<?php echo $detail['status']==1 ? 2 : htmlentities((string) $detail['status']); ?>" title="暂停执行" <?php if($detail['status']>1): ?>checked<?php endif; ?>>
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