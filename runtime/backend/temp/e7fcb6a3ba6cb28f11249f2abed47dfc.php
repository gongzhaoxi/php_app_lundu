<?php /*a:2:{s:66:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/setting/login.html";i:1755524162;s:66:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/common/layout.html";i:1764860923;}*/ ?>
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
    .layui-card .layui-form-label { width: 95px; }
    .layui-card .layui-input-block { margin-left: 125px; }
</style>

</head>
<body>
    
<div class="container">
    <div class="layui-form">
        <!-- 登录设置 -->
        <div class="layui-card">
            <div class="layui-card-header">登录设置</div>
            <div class="layui-card-body">
                <!-- 显示登录协议 -->
                <div class="layui-form-item">
                    <label class="layui-form-label"><span class="asterisk">*</span>显示登录协议:</label>
                    <div class="layui-input-block">
                        <input type="radio" name="is_agreement" value="1" title="开启" <?php if($detail['is_agreement']==1): ?>checked<?php endif; ?>>
                        <input type="radio" name="is_agreement" value="0" title="关闭" <?php if($detail['is_agreement']==0): ?>checked<?php endif; ?>>
                        <div class="layui-form-mid layui-word-aux float-none">用户登录注册时是否显示服务协议和隐私政策阅读功能</div>
                    </div>
                </div>
                <!-- 强制绑定手机 -->
                <div class="layui-form-item">
                    <label class="layui-form-label"><span class="asterisk">*</span>强制绑定手机:</label>
                    <div class="layui-input-block">
                        <input type="radio" name="force_mobile" value="1" title="开启" <?php if($detail['force_mobile']==1): ?>checked<?php endif; ?>>
                        <input type="radio" name="force_mobile" value="0" title="关闭" <?php if($detail['force_mobile']==0): ?>checked<?php endif; ?>>
                        <div class="layui-form-mid layui-word-aux float-none">用户登录注册时检测到尚未绑定手机,提示强制绑定手机号</div>
                    </div>
                </div>
                <!-- 微信授权手机 -->
                <div class="layui-form-item">
                    <label class="layui-form-label"><span class="asterisk">*</span>微信授权手机:</label>
                    <div class="layui-input-block">
                        <input type="radio" name="auths_mobile" value="1" title="开启" <?php if($detail['auths_mobile']==1): ?>checked<?php endif; ?>>
                        <input type="radio" name="auths_mobile" value="0" title="关闭" <?php if($detail['auths_mobile']==0): ?>checked<?php endif; ?>>
                        <div class="layui-form-mid layui-word-aux float-none">仅微信环境下生效,默认短信方式,强制绑定手机时生效</div>
                    </div>
                </div>
                <!-- 通用登录方式 -->
                <div class="layui-form-item">
                    <label class="layui-form-label"><span class="asterisk">*</span>通用登录方式:</label>
                    <div class="layui-input-block">
                        <input type="checkbox" name="login_modes[]" value="1" title="手机短信登录" lay-skin="primary" <?php if(in_array(1, $detail['login_modes'])): ?>checked<?php endif; ?>>
                        <input type="checkbox" name="login_modes[]" value="2" title="账号密码登录" lay-skin="primary" <?php if(in_array(2, $detail['login_modes'])): ?>checked<?php endif; ?>>
                        <div class="layui-form-mid layui-word-aux float-none">全局系统通用的登录方式,至少勾选一项</div>
                    </div>
                </div>
                <!-- 第三方登录 -->
                <div class="layui-form-item">
                    <label class="layui-form-label">第三方登录:</label>
                    <div class="layui-input-block">
                        <input type="checkbox" name="login_other[]" value="1" title="微信登录" lay-skin="primary" <?php if(in_array(1, $detail['login_other'])): ?>checked<?php endif; ?>>
                        <div class="layui-form-mid layui-word-aux float-none">支持第三方授权登录,开启后新用户授权即自动注册账号</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 保存配置 -->
        <div class="layui-card">
            <div class="layui-card-body">
                <button class="layui-btn layui-btn-default <?php echo check_perms('save', false); ?>" lay-submit lay-filter="addForm">保存配置</button>
            </div>
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
    layui.use('form', function () {
        let form = layui.form;

        form.on('submit(addForm)', function(data) {
            layer.confirm('确定保存当前配置吗?', function (index) {
                layer.close(index);
                waitUtil.ajax({
                    url: '<?php echo route("setting.login/save"); ?>',
                    type: "POST",
                    data: data.field
                });
            });
        });
    });
</script>

</body>
</html>