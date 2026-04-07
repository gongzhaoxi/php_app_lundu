<?php /*a:2:{s:67:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/setting/policy.html";i:1755524162;s:66:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/common/layout.html";i:1764860923;}*/ ?>
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
    <div class="layui-form">
        <!-- 服务协议 -->
        <div class="layui-card">
            <div class="layui-tab layui-tab-card">
                <ul class="layui-tab-title">
                    <li class="layui-this">服务协议</li>
                    <li>隐私政策</li>
                </ul>
                <div class="layui-tab-content" style="padding: 15px;">
                    <!-- 1、服务协议 -->
                    <div class="layui-tab-item layui-show">
                        <label for="service"><textarea id="service" name="service"><?php echo isset($detail['service']) ? htmlentities((string) $detail['service']) : ''; ?></textarea></label>
                    </div>
                    <!-- 2、隐私政策 -->
                    <div class="layui-tab-item">
                        <label for="privacy"><textarea id="privacy" name="privacy"><?php echo isset($detail['privacy']) ? htmlentities((string) $detail['privacy']) : ''; ?></textarea></label>
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
    layui.use(['form', 'tinymce'], function () {
        let form = layui.form;
        let tinymce = layui.tinymce;

        tinymce.render({elem: '#service'});
        tinymce.render({elem: '#privacy'});

        form.on('submit(addForm)', function() {
            let service = tinymce.get('#service').getContent();
            let privacy = tinymce.get('#privacy').getContent();

            service = service.replace("<!DOCTYPE html>\n<html>\n<head>\n</head>\n<body>\n", '');
            service = service.replace("</body>\n</html>", '');
            privacy = privacy.replace("<!DOCTYPE html>\n<html>\n<head>\n</head>\n<body>\n", '');
            privacy = privacy.replace("</body>\n</html>", '');

            layer.confirm('确定保存设置的内容吗？', function() {
                waitUtil.ajax({
                    url: '<?php echo route("setting.policy/save"); ?>',
                    type: 'POST',
                    data: {service:service, privacy:privacy}
                });
            });
        });
    });
</script>

</body>
</html>