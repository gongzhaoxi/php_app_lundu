<?php /*a:2:{s:67:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/auth/admin/add.html";i:1764058802;s:66:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/common/layout.html";i:1764860923;}*/ ?>
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
        <!-- 所属部门 -->
        <div class="layui-form-item layui-hide">
            <label for="dept_id" class="layui-form-label">所属部门：</label>
            <div class="layui-input-block">
                <select id="dept_id" name="dept_id" lay-verType="tips">
                    <option value="">请选择</option>
                    <?php if(is_array($dept) || $dept instanceof \think\Collection || $dept instanceof \think\Paginator): $i = 0; $__LIST__ = $dept;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo htmlentities((string) $vo['id']); ?>"><?php echo htmlentities((string) $vo['html']); ?> <?php echo htmlentities((string) $vo['name']); ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
        <!-- 所属岗位 -->
        <div class="layui-form-item layui-hide">
            <label for="post" class="layui-form-label">所属岗位：</label>
            <div class="layui-input-block">
                <select id="post" name="post_id" lay-verType="tips">
                    <option value="">请选择</option>
                    <?php if(is_array($post) || $post instanceof \think\Collection || $post instanceof \think\Paginator): $i = 0; $__LIST__ = $post;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo htmlentities((string) $vo['id']); ?>"><?php echo htmlentities((string) $vo['name']); ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
        <!-- 所属角色 -->
        <div class="layui-form-item">
            <label for="role_id" class="layui-form-label"><span class="asterisk">*</span>所属角色：</label>
            <div class="layui-input-block">
                <select id="role_id" name="role_id" lay-verType="tips" lay-verify="required|number">
                    <option value="">请选择</option>
                    <?php if(is_array($roles) || $roles instanceof \think\Collection || $roles instanceof \think\Paginator): $i = 0; $__LIST__ = $roles;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo htmlentities((string) $vo['id']); ?>"><?php echo htmlentities((string) $vo['name']); ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
        <!-- 用户昵称 -->
        <div class="layui-form-item">
            <label for="nickname" class="layui-form-label"><span class="asterisk">*</span>用户昵称：</label>
            <div class="layui-input-block">
                <input type="text" id="nickname" name="nickname"
                       autocomplete="off" class="layui-input" lay-verType="tips" lay-verify="required">
            </div>
        </div>
        <!-- 登录账号 -->
        <div class="layui-form-item">
            <label for="username" class="layui-form-label"><span class="asterisk">*</span>登录账号：</label>
            <div class="layui-input-block">
                <input type="text" id="username" name="username"
                       autocomplete="off" class="layui-input" lay-verType="tips" lay-verify="required">
            </div>
        </div>
        <!-- 登录密码 -->
        <div class="layui-form-item">
            <label for="password" class="layui-form-label"><span class="asterisk">*</span>登录密码：</label>
            <div class="layui-input-block">
                <input type="password" id="password" name="password"
                       autocomplete="off" class="layui-input" lay-verType="tips" lay-verify="required">
            </div>
        </div>
        <!-- 电子邮箱 -->
        <div class="layui-form-item">
            <label for="email" class="layui-form-label">电子邮箱：</label>
            <div class="layui-input-block">
                <input type="text" id="email" name="email"
                       autocomplete="off" class="layui-input" lay-verType="tips">
            </div>
        </div>
        <!-- 联系电话 -->
        <div class="layui-form-item">
            <label for="phone" class="layui-form-label">联系电话：</label>
            <div class="layui-input-block">
                <input type="number" id="phone" name="phone"
                       autocomplete="off" class="layui-input" lay-verType="tips">
            </div>
        </div>
        <!-- 状态 -->
        <div class="layui-form-item">
            <label class="layui-form-label">状态：</label>
            <div class="layui-input-block">
                <input type="radio" name="is_disable" value="0" title="正常" checked>
                <input type="radio" name="is_disable" value="1" title="禁用">
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