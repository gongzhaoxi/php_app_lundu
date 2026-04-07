<?php /*a:2:{s:65:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/common/login.html";i:1764942483;s:66:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/common/layout.html";i:1764860923;}*/ ?>
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
    
<link rel="stylesheet" href="/static/backend/css/login.css">

</head>
<body>
    
<div class="login-wrapper layui-anim layui-anim-scale">
    <form class="layui-form" onsubmit="return false">
        <h2>海涛船班</h2>
        <div class="layui-form-item layui-input-icon-group">
            <label for="username" class="layui-form-label" style="display: none;"></label>
            <i class="layui-icon layui-icon-username"></i>
            <input type="text"  id="username" name="username" class="layui-input" placeholder="请输入登录账号"
                   autocomplete="off" lay-vertype="tips" lay-verify="required">
        </div>
        <div class="layui-form-item layui-input-icon-group">
            <label for="password" class="layui-form-label" style="display: none;"></label>
            <i class="layui-icon layui-icon-password"></i>
            <input type="password"  id="password" name="password" class="layui-input" placeholder="请输入登录密码"
                   lay-vertype="tips" lay-verify="required">
        </div>
        <div class="layui-form-item layui-input-icon-group login-captcha-group">
            <label for="captcha" class="layui-form-label" style="display: none;"></label>
            <i class="layui-icon layui-icon-auz"></i>
            <input type="text" id="captcha" name="captcha" class="layui-input" placeholder="请输入验证码" autocomplete="off"
                   lay-vertype="tips" lay-verify="required">
            <img src="<?php echo htmlentities((string) $entrance); ?>/captcha.html" class="login-captcha"
                 onclick="this.src='<?php echo htmlentities((string) $entrance); ?>/captcha.html?'+Math.random()"
                 width="130px" height="48px" alt="点击刷新验证码">
        </div>
        <div class="layui-form-item">
            <label for="remember" class="layui-form-label" style="display: none;"></label>
            <input type="checkbox" id="remember" name="remember" title="记住密码" lay-skin="primary" checked="">
            <div class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin="primary">
                <span>记住密码</span><i class="layui-icon layui-icon-ok"></i>
            </div>
        </div>
        <div class="layui-form-item">
            <button class="layui-btn layui-btn-fluid layui-btn-default" id="login" lay-filter="loginSubmit" lay-submit="">登录</button>
        </div>
    </form>
</div>
<div class="login-copyright">Copyright © 2022 www.waitAdmin.cn all rights reserved.</div>

    <script src="/static/common/library/layui/layui.js"></script>
    <script src="/static/common/library/jquery.min.js"></script>
    <script src="/static/common/library/cache.min.js"></script>
    <script src="/static/backend/js/sortable.min.js"></script>
    <script src="/static/backend/js/config.min.js"></script>
    <script src="/static/backend/js/utils.min.js"></script>
    
<script>
    layui.use(['form'], function () {
        let $ = layui.$;
        let form = layui.form;

        let theme = waitCache.getItem('theme');
        if (theme && theme !== waitConfig.theme) {
            $('body').attr('data-theme', theme);
        }

        //如果是iframe,跳转到顶层
        if (window !== top) {
            top.location.href = location.href;
        }

        // 监听提交登录
        form.on('submit(loginSubmit)', function(data) {
            if (data.field['captcha'].length < 1) {
                return;
            }
            const that = $(this)
            rememberPass();
            waitUtil.locking(that);
            waitUtil.ajax({
                url: '<?php echo route("login/check"); ?>',
                type: 'POST',
                data: data.field,
                fulShow: false,
                errShow: false
            }).then((res) => {
                if (res.code === 0) {
                    layer.msg(res.msg, {icon: 1, time: 1000}, function () {
                        location.href = '<?php echo route("index"); ?>'
                    });
                } else {
                    layer.msg(res.msg, {icon: 2, time: 1000});
                    $('.login-captcha').trigger('click');
                }

                setTimeout(function () {
                    waitUtil.unlock(that);
                }, 1500)
            }).catch(() => {
                waitUtil.unlock(that);
            });
        });

        // 取出密码自动填充
        let user = localStorage.getItem('keyName');
        let pass = localStorage.getItem('keyPass');
        if(user){
            $('#username').val(user);
        }
        if(pass){
            $('#password').val(pass);
        }

        // 记住密码
        function rememberPass() {
            let strName = $('#username').val();
            let strPass = $('#password').val();
            if($('#remember').is(':checked')){
                localStorage.setItem('keyName', strName);
                localStorage.setItem('keyPass', strPass);
            }else{
                localStorage.removeItem('keyName');
                localStorage.removeItem('keyPass');
            }
        }
    });
</script>

</body>
</html>