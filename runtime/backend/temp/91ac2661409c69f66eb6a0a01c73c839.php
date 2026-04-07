<?php /*a:2:{s:68:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/diy/theme/index.html";i:1755524162;s:66:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/common/layout.html";i:1764860923;}*/ ?>
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
    .theme-radio-group { display: flex; padding: 20px 0 20px 30px; }
    .theme-radio-group .theme-radio-title { margin-right: 10px; color: #515a6e; }
    .theme-radio-group .theme-radio-body { display: flex; flex-wrap: wrap; overflow-x: auto; }
    .theme-radio-group .item { display: flex; align-items: center; justify-content: center; margin-right: 20px; margin-bottom: 10px; width: 120px; height: 50px; color: #666666; border: 1px solid #dcdee2; border-radius: 4px; text-align: center; line-height: 40px; }
    .theme-radio-group .item.active { border-color: var(--theme-color); background: #f9f9f9; }
    .theme-radio-group .item .color {margin-right: 10px;width: 20px;height: 20px;border: 0;border-radius: 3px;}
    .theme-radio-group .item .color.green { background-color: #40ca4d; }
    .theme-radio-group .item .color.blue { background-color: #2979ff; }
    .theme-radio-group .item .color.red { background-color: #ff5058; }
    .theme-radio-group .image { width: 800px; height: 100%; padding: 15px; border-radius: 6px; box-sizing: border-box; background: #f8f8f8; }
    .container .layui-card { min-width: 436px; }
</style>

</head>
<body>
    
<div class="container layui-form">
    <!-- 主题风格 -->
    <div class="layui-card">
        <div class="layui-card-header">主题风格</div>
        <div class="layui-card-body">
            <!-- 选择配色方案 -->
            <div class="theme-radio-group">
                <div class="theme-radio-title">选择配色方案：</div>
                <div class="theme-radio-body">
                    <!-- 天空蓝 -->
                    <div class="item <?php if($detail['subject']=='blue-theme' || !$detail['subject']): ?>active<?php endif; ?>"
                         data-subject="blue-theme"
                         data-color="#2979ff"
                    >
                        <span class="color blue"></span>
                        <div class="text">天空蓝</div>
                    </div>
                    <!-- 热情红 -->
                    <div class="item <?php if($detail['subject']=='red-theme'): ?>active<?php endif; ?>"
                         data-subject="red-theme"
                         data-color="#ff5058"
                    >
                        <span class="color red"></span>
                        <div class="text">热情红</div>
                    </div>
                    <!-- 生鲜绿 -->
                    <div class="item <?php if($detail['subject']=='green-theme'): ?>active<?php endif; ?>"
                         data-subject="green-theme"
                         data-color="#40ca4d"
                    >
                        <span class="color green"></span>
                        <div class="text">生鲜绿</div>
                    </div>
                </div>
            </div>

            <!-- 当前风格示例 -->
            <div class="theme-radio-group">
                <div class="theme-radio-title">当前风格示例：</div>
                <div class="theme-radio-body">
                    <div class="image">
                        <img class="w-h-full" src="/static/backend/images/diy/theme/<?php echo isset($detail['subject']) ? htmlentities((string) $detail['subject']) : 'blue-theme'; ?>.png" alt="blue">
                    </div>
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

        $(document).on('click', '.theme-radio-body .item', function () {
            $(this).siblings().removeClass('active');
            $(this).addClass('active');

            const subject = $(this).attr('data-subject');
            const src = '/static/backend/images/diy/theme/'+subject+'.png';
            const el  = '.theme-radio-body img';
            $(el).attr('src', src);
        });

        form.on('submit(addForm)', function() {
            const that = this;
            waitUtil.locking(that)
            layer.confirm('确定保存当前配置吗?', function (index) {
                layer.close(index);
                const app = $('.theme-radio-body .item.active');
                const subject = app.attr('data-subject');
                const color   = app.attr('data-color');
                waitUtil.ajax({
                    url: '<?php echo route("diy.theme/save"); ?>',
                    type: 'POST',
                    fulShow: false,
                    data: {
                        subject: subject,
                        color: color
                    }
                }).then(() => {
                    waitUtil.unlock(that);
                }).catch(() => {
                    waitUtil.unlock(that);
                });
            });
        });
    })
</script>

</body>
</html>