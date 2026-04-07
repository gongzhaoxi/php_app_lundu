<?php /*a:3:{s:69:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/diy/person/index.html";i:1755524162;s:66:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/common/layout.html";i:1764860923;s:69:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/diy/person/phone.html";i:1755524162;}*/ ?>
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
    .layui-card-body { display: flex !important; }
    .editor { position: relative; z-index: 200; padding: 20px 10px; width: 400px; height: auto; border: 1px solid #dddddd; border-radius: 5px; text-align: left; background: #fdfdfd; }
    .editor::after { position: absolute; top: 25px; left: -9px; z-index: 100; display: block; width: 15px; height: 15px; border-right: 1px solid #dddddd; border-bottom: 1px solid #dddddd; background: #fdfdfd; content: ""; transform: rotate(135deg); }
    .editor .list .item { position: relative; display: flex; align-items: center; overflow: hidden; margin-bottom: 10px; padding: 10px; height: auto; border: 1px solid #e7eaec; border-radius: 3px; background: #ffffff; }
    .editor .list .item:hover .close { display: block; }
    .editor .list .item .layui-icon-close { position: absolute; top: 4px; right: 4px; display: none; padding: 3px; font-size: 12px; border-radius: 50%; color: #ffffff; background: rgba(0, 0, 0, .3); line-height: 1; }
    .editor .list .item .layui-icon-close:hover { background: rgba(0, 0, 0, .7); }
    .editor .list .item .icon { position: relative; display: flex; align-items: center; justify-content: center; width: 60px; height: 60px; border: 1px #dcdfe6 dashed; background-color: #f8f8f8; }
    .editor .list .item .icon .layui-icon-addition { font-size: 24px; color: #999999; }
    .editor .list .item .icon .layui-icon-close { top: -9px; right: -6px; }
    .editor .list .item .icon:hover .select { display: block; }
    .editor .list .item .icon.big { width: 100px; height: 80px; }
    .editor .list .item img { max-width: 100%; max-height: 100%; }
    .editor .list .item .form { flex: 1; margin-left: 10px; }
    .editor .list .item .form label:first-child input { margin-bottom: 8px; }
    .editor .add-btn { padding: 6px 12px; font-size: 12px; border: 1px solid #efefef; text-align: center; white-space: nowrap; color: #6b6b6b; background: #fdfdfd !important; transition: background-color 0.3s; cursor: pointer; }
</style>

</head>
<body>
    
<div class="container layui-form" lay-filter="form-filter">
    <div class="layui-card">
        <div class="layui-card-body">
            <!-- 手机演示 -->
            <style>
    .phone { --phone-color: <?php echo htmlentities((string) $detail['themeColor']); ?>;}
    .phone .top-bar { position: relative; min-height: 70px; background: url("/static/backend/images/diy/phone-top-white.png") center center / contain no-repeat var(--phone-color); }
    .phone .top-bar .title { position: absolute; bottom: 10px; left: 155px; font-size: 14px; color: #ffffff; }
    .phone .header { display: flex; justify-content: space-between; background-color: var(--phone-color); }
    .phone .header .user { display: flex; align-items: center; padding: 6px 15px 20px; color: #ffffff; }
    .phone .header .user .avatar { width: 60px; height: 60px; border-radius: 50%; }
    .phone .header .user .login { margin-left: 10px; padding: 4px; width: 85px; font-size: 14px; border: 1px solid #ffffff; border-radius: 25px; text-align: center; color: #ffffff; }
    .phone .header .other { padding-top: 15px; }
    .phone .header .other .layui-icon { padding: 0 10px; font-size: 22px; color: #ffffff; }

    .phone { position: relative; margin-right: 25px; width: 360px; min-width: 360px; height: 700px; border: 1px solid #dddddd; color: #333333; background-color: #f7f7f7; }
    .phone .bottom { position: absolute; bottom: 0; display: flex; justify-content: space-between; width: 100%; height: 50px; background-color: #ffffff; box-sizing: border-box; }
    .phone .bottom .item { display: flex; align-items: center; flex-direction: column; justify-content: center; width: 33.33%; }
    .phone .bottom .item img { width: 22px; height: 22px; }
    .phone .bottom .item .text { line-height: 1.6; }

    #phoneView { overflow: hidden; overflow-y: auto; padding: 10px 0; height: 494px; box-sizing: border-box; }
    .phone-diy { border: 2px rgb(220 223 230) dashed; }
    .phone-diy.on { border: 2px var(--phone-color) dashed; }
    .phone-service { margin: 0 10px; border-radius: 4px; background-color: #ffffff; }
    .phone-service .service-header { display: flex; align-items: center; justify-content: space-between; padding: 15px 10px 5px; font-size: 15px; font-weight: 600; color: #282828; }
    .phone-service .service-mould { display: flex; align-items: center; flex-wrap: wrap; padding: 7px 0; }
    .phone-service .service-mould .item { display: flex; align-items: center; flex-direction: column; justify-content: center; margin: 9px 0; }
    .phone-service .service-mould .item .name { height: 22px; }
    .phone-service .service-mould .item img { width: 30px; height: 30px; }
    .phone-service .service-lists { display: flex; flex-direction: column; }
    .phone-service .service-lists .item { display: flex; align-items: center; padding: 0 10px; height: 50px; border-bottom: 1px solid #f6f6f6; }
    .phone-service .service-lists .item img { margin-right: 6px; width: 24px; height: 24px; vertical-align: top; }
    .phone-service .service-lists .item .name { flex: 1; }

    .phone-service #adv img { width: 100%; height: 100%; }
</style>

<div class="phone">
    <div class="top-bar">
        <div class="title">个人中心</div>
    </div>
    <div class="header">
        <div class="user">
            <img class="avatar" src="/static/backend/images/avatar.png" alt="avatar">
            <div class="login">立即登录</div>
        </div>
        <div class="other">
            <i class="layui-icon icon-setup-fill"></i>
        </div>
    </div>
    <div id="phoneView"></div>
    <div class="bottom">
        <?php if(is_array($tabBar['list']) || $tabBar['list'] instanceof \think\Collection || $tabBar['list'] instanceof \think\Paginator): $i = 0; $__LIST__ = $tabBar['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <div class="item scale<?php echo count($tabBar['list']); ?>">
                <img src="<?php echo htmlentities((string) $vo['iconPath']); ?>" alt="icon">
                <div class="text"><?php echo htmlentities((string) $vo['text']); ?></div>
            </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>

<script id="phoneTpl" type="text/html">
    <div class="phone-diy on" data-type="service">
        <div class="phone-service">
            <div class="service-header">{{ d.service.base.title }}</div>
            {{#  if(d.service.base.layout === 'row'){ }}
                <div class="service-mould">
                    {{#  layui.each(d.service.list, function(index, item){ }}
                        <div class="item w-scale-{{ d.service.base.number }}">
                            <img src="{{ item.image }}" alt="ico">
                            <div class="name">{{ item.name }}</div>
                        </div>
                    {{#  }); }}
                </div>
            {{#  } else { }}
                <div class="service-lists">
                    {{#  layui.each(d.service.list, function(index, item){ }}
                        <div class="item">
                            <img src="{{ item.image }}" alt="ico">
                            <div class="name">{{ item.name }}</div>
                            <i class="layui-icon layui-icon-right"></i>
                        </div>
                    {{#  }); }}
                </div>
            {{#  } }}
        </div>
    </div>

    <div class="phone-diy" data-type="adv" style="margin-top: 10px; padding: 0 10px;">
        <div class="layui-carousel" id="adv">
            <div carousel-item>
                {{#  layui.each(d.adv.list, function(index, item){ }}
                    <img src="{{ item.image }}" alt="img" style="border-radius: 4px;">
                {{#  }); }}
            </div>
        </div>
    </div>
</script>


            <!-- 服务设置 -->
            <div class="editor service" data-type="service">
                <div class="layui-form-item">
                    <label class="layui-form-label">排版样式</label>
                    <div class="layui-input-block">
                        <input type="radio" name="service_layout" value="row" title="横排" lay-filter="layout-filter" <?php if($detail['service']['base']['layout']=='row'): ?>checked<?php endif; ?>>
                        <input type="radio" name="service_layout" value="col" title="竖排" lay-filter="layout-filter" <?php if($detail['service']['base']['layout']=='col'): ?>checked<?php endif; ?>>
                    </div>
                </div>
                <div class="layui-form-item service_number <?php if($detail['service']['base']['layout']=='col'): ?>layui-hide<?php endif; ?>">
                    <label class="layui-form-label" lay-tips="注意: 此参数在“竖排”时不会生效">排版数量</label>
                    <div class="layui-input-block">
                        <input type="radio" name="service_number" value="3" title="3" lay-filter="number-filter" <?php if($detail['service']['base']['number']=='3'): ?>checked<?php endif; ?>>
                        <input type="radio" name="service_number" value="4" title="4" lay-filter="number-filter" <?php if($detail['service']['base']['number']=='4'): ?>checked<?php endif; ?>>
                        <input type="radio" name="service_number" value="5" title="5" lay-filter="number-filter" <?php if($detail['service']['base']['number']=='5'): ?>checked<?php endif; ?>>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="service_title" class="layui-form-label">标题名称</label>
                    <div class="layui-input-block">
                        <input type="text" id="service_title" name="service_title" value="<?php echo htmlentities((string) $detail['service']['base']['title']); ?>"
                               placeholder="请输入标题" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="list" id="serviceDrag">
                    <?php if(is_array($detail['service']['list']??[]) || $detail['service']['list']??[] instanceof \think\Collection || $detail['service']['list']??[] instanceof \think\Paginator): $i = 0; $__LIST__ = $detail['service']['list']??[];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <div class="item">
                            <i class="layui-icon layui-icon-close close"></i>
                            <div class="icon">
                                <?php if(!$vo['image']): ?>
                                    <img src="<?php echo htmlentities((string) $vo['image']); ?>" alt="icon" style="display: none;">
                                    <i class="layui-icon layui-icon-addition"></i>
                                    <i class="layui-icon layui-icon-close"></i>
                                <?php else: ?>
                                    <img src="<?php echo htmlentities((string) $vo['image']); ?>" alt="icon">
                                    <i class="layui-icon layui-icon-addition" style="display: none;"></i>
                                    <i class="layui-icon layui-icon-close select"></i>
                                <?php endif; ?>
                            </div>
                            <div class="form">
                                <label><input type="text" name="name" value="<?php echo htmlentities((string) $vo['name']); ?>" placeholder="请输入标题" autocomplete="off" class="layui-input"></label>
                                <label><input type="text" name="link" value="<?php echo htmlentities((string) $vo['link']); ?>" placeholder="请输入标题" autocomplete="off" class="layui-input"></label>
                            </div>
                        </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <div class="add-btn">添加一个</div>
            </div>

            <!-- 轮播设置 -->
            <div class="editor adv layui-hide" data-type="adv">
                <div class="layui-form-item">
                    <label class="layui-form-label">是否启用</label>
                    <div class="layui-input-block">
                        <input type="radio" name="adv_open" value="1" title="开启" <?php if($detail['adv']['base']['open']==1): ?>checked<?php endif; ?>>
                        <input type="radio" name="adv_open" value="0" title="关闭" <?php if($detail['adv']['base']['open']==0): ?>checked<?php endif; ?>>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">图片设置</label>
                    <div class="layui-form-mid layui-word-aux">最多添加5张，建议图片尺寸：750px*200px</div>
                </div>
                <div class="list" id="advDrag">
                    <?php if(is_array($detail['adv']['list']??[]) || $detail['adv']['list']??[] instanceof \think\Collection || $detail['adv']['list']??[] instanceof \think\Paginator): $i = 0; $__LIST__ = $detail['adv']['list']??[];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <div class="item">
                            <i class="layui-icon layui-icon-close close"></i>
                            <div class="icon big">
                                <?php if(!$vo['image']): ?>
                                    <img src="<?php echo htmlentities((string) $vo['image']); ?>" alt="icon" style="display: none;">
                                    <i class="layui-icon layui-icon-addition"></i>
                                    <i class="layui-icon layui-icon-close"></i>
                                <?php else: ?>
                                    <img src="<?php echo htmlentities((string) $vo['image']); ?>" alt="icon">
                                    <i class="layui-icon layui-icon-addition" style="display: none;"></i>
                                    <i class="layui-icon layui-icon-close select"></i>
                                <?php endif; ?>
                            </div>
                            <div class="form">
                                <label><input type="text" name="name" value="<?php echo htmlentities((string) $vo['name']); ?>" placeholder="图片名称" autocomplete="off" class="layui-input"></label>
                                <label><input type="text" name="link" value="<?php echo htmlentities((string) $vo['link']); ?>" placeholder="图片链接" autocomplete="off" class="layui-input"></label>
                            </div>
                        </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <div class="add-btn">添加一个</div>
            </div>
        </div>
    </div>
    <div class="layui-card">
        <div class="layui-card-body">
            <button class="layui-btn layui-btn-default <?php echo check_perms('save', false); ?>" lay-submit="" lay-filter="addForm">保存配置</button>
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
    layui.use(['form', 'laytpl', 'carousel'], function() {
        let $ = layui.$;
        let form = layui.form;
        let laytpl = layui.laytpl;
        let carousel = layui.carousel;

        // 排版样式
        form.on('radio(layout-filter)', function(data){
            if (data.value === 'col') {
                $('.service_number').addClass('layui-hide')
            } else {
                $('.service_number').removeClass('layui-hide')
            }

            const diyData = {field: form.val('form-filter')}
            handleData(diyData)
        });

        // 排版数量
        form.on('radio(number-filter)', function(){
            const diyData = {field: form.val('form-filter')}
            handleData(diyData)
        });

        // 处理数据
        function handleData(data) {
            let listData = {};

            try {
                $('.editor').each(function () {
                    let type    = $(this).attr('data-type');
                    let itemArr = $(this).find('.list .item');
                    let results = {}

                    switch (type) {
                        case 'service':
                            results['base'] = {
                                'layout': data.field['service_layout'],
                                'title': data.field['service_title'],
                                'number': data.field['service_number']
                            }
                            break;
                        case 'adv':
                            results['base'] = {'open': data.field['adv_open']}
                            if (itemArr.length > 5) {
                                throw new Error('抱歉元素不能超出5个');
                            }
                    }

                    let list = [];
                    itemArr.each(function () {
                        let image = $(this).find('img').attr('src');
                        let name  = $(this).find("input[name='name']").val();
                        let link  = $(this).find("input[name='link']").val();
                        list.push({image: image, name: name, link:link});
                    });

                    results['list'] = list;
                    listData[type] = results;
                });
            } catch (e) {
                return layer.msg(e.message, {icon: 2});
            }

            renderService(listData);

            return listData;
        }

        // 渲染服务
        function renderService(data) {
            let getTpl = document.getElementById('phoneTpl').innerHTML;
            let view = document.getElementById('phoneView');
            laytpl(getTpl).render(data, function(html){
                view.innerHTML = html;
                carousel.render({elem: '#adv', width: '100%', arrow: 'none', height: 120, indicator: 'none'});
            });
        }

        // 初始化值
        renderService(JSON.parse('<?php echo $jsonp; ?>'));
        carousel.render({
            elem: '#adv',
            width: '100%',
            arrow: 'none',
            height: 120,
            interval: 8000,
            indicator: 'none'
        });

        // 拖动效果
        let elService = document.getElementById('serviceDrag');
        let elAdv = document.getElementById('advDrag');
        Sortable.create(elService, {animation: 150, ghostClass: 'blue-background-class'});
        Sortable.create(elAdv, {animation: 150, ghostClass: 'blue-background-class'});

        // 切换模块
        $(document).on('click', '.phone-diy', function () {
            $('.phone-diy').removeClass('on');
            $('.editor').addClass('layui-hide');
            $(this).addClass('on');

            let type = $(this).attr('data-type');
            $('.editor.'+type).removeClass('layui-hide');
        });

        // 创建模块
        $(document).on('click', '.add-btn', function () {
            let type = $(this).parents('.editor').attr('data-type');
            let size = '';

            if (type === 'adv') {
                size = ' big';
                let itemArr = $(this).parents('.editor').find('.list .item');
                if (itemArr.length > 4) {
                    return layer.msg('您已超出规定的5个元素!', {icon: 2})
                }
            }

            let html = '<div class="item">';
            html += '<i class="layui-icon layui-icon-close close"></i>';
            html += '<div class="icon'+size+'">'
            html += '<img src="" alt="" style="display: none;">';
            html += '<i class="layui-icon layui-icon-addition"></i>';
            html += '<i class="layui-icon layui-icon-close"></i>';
            html += '</div>'
            html += '<div class="form">';
            html += '<label><input type="text" name="name" placeholder="请输入名称" autocomplete="off" class="layui-input"></label>';
            html += '<label><input type="text" name="link" placeholder="请选择链接" autocomplete="off" class="layui-input"></label>';
            html += '</div></div>';
            $(this).prev().append(html)

            const diyData = {field: form.val('form-filter')}
            handleData(diyData)
        });

        // 删除模块
        $(document).on('click', '.editor .item .close', function () {
            let itemArr = $(this).parents('.editor').find('.list .item');
            if (itemArr.length <= 1) {
                return layer.msg('请至少保留1个元素', {icon: 2});
            }
            $(this).parent().remove();

            const diyData = {field: form.val('form-filter')}
            handleData(diyData)
        });

        // 选择图标
        $(document).on('click', '.editor .item .icon', function (e) {
            e.preventDefault()
            let that = $(this);
            waitUtil.uploader().then(data => {
                let imgNode = $(that).find('img');
                imgNode.attr('src', data[0].url);
                imgNode.show();
                $(that).children('.layui-icon-addition').hide();
                $(that).children('.layui-icon-close').addClass('select');
            });

            const diyData = {field: form.val('form-filter')}
            handleData(diyData)
        });

        // 删除图标
        $(document).on('click', '.editor .item .icon .layui-icon-close', function (e) {
            e.stopPropagation();
            $(this).parent().children('img').eq(0).attr('src', '');
            $(this).parent().children('img').eq(0).hide();
            $(this).parent().children('.layui-icon-addition').show();
            $(this).parent().children('.layui-icon-close').removeClass('select');

            const diyData = {field: form.val('form-filter')}
            handleData(diyData)
        });

        // 输入框变化
        $(document).on('input', '.editor .list .form label:first-child input', waitUtil.debounce(200, function () {
            const diyData = {field: form.val('form-filter')}
            handleData(diyData)
        }));

        // 提交表单
        form.on('submit(addForm)', function(data) {
            layer.confirm('确定保存当前配置吗?', function(index) {
                layer.close(index);
                waitUtil.ajax({
                    url: '<?php echo route("diy.person/save"); ?>',
                    type: 'POST',
                    data: handleData(data)
                });
            });
        });
    });
</script>

</body>
</html>