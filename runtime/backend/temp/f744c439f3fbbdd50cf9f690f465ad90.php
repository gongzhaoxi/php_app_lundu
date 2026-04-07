<?php /*a:2:{s:65:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/common/error.html";i:1755524162;s:66:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/common/layout.html";i:1764860923;}*/ ?>
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
    
<style>
    .container {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        display: flex;
        align-items: center;
        flex-direction: column;
        justify-content: center;
        overflow: hidden;
        text-align: center;
    }
    .node { text-align: center; }
    .node i { font-size: 200px; color: #999999; }
    .node p { margin-top: 10px; font-size: 14px; color: #999999; }
</style>

</head>
<body>
    
<div class="container">
    <div class="node">
        <?php if($errCode == 404): ?>
            <i class="layui-icon layui-icon-404"></i>
        <?php else: ?>
            <i class="layui-icon layui-icon-face-surprised"></i>
        <?php endif; ?>
        <p><?php echo htmlentities((string) $errMsg); ?></p>
    </div>
</div>

    <script src="/static/common/library/layui/layui.js"></script>
    <script src="/static/common/library/jquery.min.js"></script>
    <script src="/static/common/library/cache.min.js"></script>
    <script src="/static/backend/js/sortable.min.js"></script>
    <script src="/static/backend/js/config.min.js"></script>
    <script src="/static/backend/js/utils.min.js"></script>
    
</body>
</html>