<?php /*a:2:{s:64:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/index/index.html";i:1764942429;s:66:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/common/layout.html";i:1764860923;}*/ ?>
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
    
<link rel="stylesheet" href="/static/backend/css/kernel.css">

</head>
<body>
    
<div id="app">
    <!-- 导航区域 -->
    <div class="wait-header">
        <ul class="layui-nav layui-layout-left">
            <li class="layui-nav-item">
                <a href="javascript:" class="stretch" title="菜单切换">
                    <i class="layui-icon layui-icon-shrink-right"></i>
                </a>
            </li>
            <li class="layui-nav-item">
                <a class="refresh" href="javascript:" title="刷新">
                    <i class="layui-icon layui-icon-refresh-3"></i>
                </a>
            </li>
        </ul>
        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item layui-hide-xs">
                <a class="fullscreen" href="javascript:" title="全屏">
                    <i class="layui-icon layui-icon-screen-full"></i>
                </a>
            </li>
            <li class="layui-nav-item">
                <a href="javascript:">
                    <img src="<?php echo htmlentities((string) $adminUser['avatar']); ?>" class="layui-nav-img" alt="avatar">
                    <?php echo htmlentities((string) $adminUser['username']); ?>
                    <span class="layui-nav-more"></span>
                </a>
                <dl class="layui-nav-child layui-anim layui-anim-upbit user-info">
                    <dd class="info" lay-event="info"><a href="javascript:">基本资料</a></dd>
                    <dd><hr></dd>
                    <dd class="logout" lay-event="logout"><a href="javascript:">退出登录</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item layui-hide-xs">
                <a href="javascript:" class="about" lay-event="about">
                    <i class="layui-icon layui-icon-more-vertical"></i>
                </a>
            </li>
        </ul>
    </div>

    <!-- 菜单区域 -->
    <div class="wait-sidebar">
        <div class="logo" style="background: #20222a url(<?php echo htmlentities((string) $logo); ?>) no-repeat center;"></div>
        <ul>
            <?php if(is_array($menus) || $menus instanceof \think\Collection || $menus instanceof \think\Paginator): $k = 0; $__LIST__ = $menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;if(!$vo['children']): ?>
                <li class="wait-menu-item <?php if($k==1): ?>on<?php endif; ?>">
                    <a lay-id="<?php echo $vo['title']=='首页' ? '0'  : htmlentities((string) $vo['id']); ?>"
                       lay-attr="<?php echo route($vo['title']=='首页' ? 'index/console' : $vo['perms']); ?>" >
                        <i class="<?php echo htmlentities((string) $vo['icon']); ?>"></i>
                        <cite><?php echo htmlentities((string) $vo['title']); ?></cite>
                    </a>
                </li>
            <?php else: ?>
                <li class="wait-menu-item">
                    <a href="javascript:">
                        <i class="<?php echo htmlentities((string) $vo['icon']); ?>"></i>
                        <cite><?php echo htmlentities((string) $vo['title']); ?></cite>
                        <span class="layui-icon layui-icon-left"></span>
                    </a>
                    <dl class="wait-second-menu">
                        <?php if(is_array($vo['children']) || $vo['children'] instanceof \think\Collection || $vo['children'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['children'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;if(!$item['children']): ?>
                                <dd>
                                    <a lay-id="<?php echo htmlentities((string) $item['id']); ?>" lay-attr="<?php echo route($item['perms']); ?>">
                                        <i class="<?php echo htmlentities((string) $item['icon']); ?>"></i>
                                        <cite><?php echo htmlentities((string) $item['title']); ?></cite>
                                    </a>
                                </dd>
                            <?php else: ?>
                                <dd>
                                    <a href="javascript:">
                                        <i class="<?php echo htmlentities((string) $item['icon']); ?>"></i>
                                        <cite><?php echo htmlentities((string) $item['title']); ?></cite>
                                        <span class="layui-icon layui-icon-left"></span>
                                    </a>
                                    <dl>
                                        <?php if(is_array($item['children']) || $item['children'] instanceof \think\Collection || $item['children'] instanceof \think\Paginator): $i = 0; $__LIST__ = $item['children'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub): $mod = ($i % 2 );++$i;if(!$sub['children']): ?>
                                                <!-- 二级菜单 -->
                                                <dd>
                                                    <a lay-id="<?php echo htmlentities((string) $sub['id']); ?>" lay-attr="<?php echo route($sub['perms']); ?>">
                                                        <i class="<?php echo htmlentities((string) $sub['icon']); ?>"></i>
                                                        <cite><?php echo htmlentities((string) $sub['title']); ?></cite>
                                                    </a>
                                                </dd>
                                            <?php else: ?>
                                                <!-- 三级菜单 -->
                                                <dd class="tree">
                                                    <a href="javascript:">
                                                        <i class="<?php echo htmlentities((string) $sub['icon']); ?>"></i>
                                                        <cite><?php echo htmlentities((string) $sub['title']); ?></cite>
                                                        <span class="layui-icon layui-icon-left"></span>
                                                    </a>
                                                    <dl>
                                                        <?php if(is_array($sub['children']) || $sub['children'] instanceof \think\Collection || $sub['children'] instanceof \think\Paginator): $i = 0; $__LIST__ = $sub['children'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$treeNode): $mod = ($i % 2 );++$i;?>
                                                            <dd>
                                                                <a lay-id="<?php echo htmlentities((string) $treeNode['id']); ?>" lay-attr="<?php echo route($treeNode['perms']); ?>">
                                                                    <i class="<?php echo htmlentities((string) $treeNode['icon']); ?>"></i>
                                                                    <cite><?php echo htmlentities((string) $treeNode['title']); ?></cite>
                                                                </a>
                                                            </dd>
                                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                                    </dl>
                                                </dd>
                                            <?php endif; ?>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </dl>
                                </dd>
                            <?php endif; ?>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </dl>
                </li>
            <?php endif; ?>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>

    <!-- 标签区域 -->
    <div class="wait-tabs">
        <div class="layui-icon lay-tabs-control layui-icon-prev" lay-event="leftPage"></div>
        <div class="layui-icon lay-tabs-control layui-icon-next" lay-event="rightPage"></div>
        <div class="layui-icon lay-tabs-control layui-icon-down">
            <ul class="layui-nav lay-tabs-select">
                <li class="layui-nav-item">
                    <a href="javascript:"><span class="layui-nav-more"></span></a>
                    <dl class="layui-nav-child layui-anim-fadein11 ">
                        <dd lay-event="closeThisTabs"><a href="javascript:">关闭当前标签页</a></dd>
                        <dd lay-event="closeOtherTabs"><a href="javascript:">关闭其它标签页</a></dd>
                        <dd lay-event="closeAllTabs"><a href="javascript:">关闭全部标签页</a></dd>
                    </dl>
                </li>
            </ul>
        </div>
        <div class="layui-tab" lay-unauto lay-allowclose="true" lay-filter="tab-body-filter">
            <ul class="layui-tab-title">
                <li lay-id="0" lay-attr="<?php echo route('index/console'); ?>" class="layui-this">
                    <i class="layui-icon layui-icon-home"></i>
                    <i class="layui-icon layui-tab-close"></i>
                </li>
            </ul>
        </div>
    </div>

    <!-- 主体区域 -->
    <div class="wait-body">
        <div lay-id="0" class="tab-body-item layui-show">
            <iframe src="<?php echo route('index/console'); ?>"></iframe>
        </div>
    </div>

    <!-- 辅助遮罩 -->
    <div class="wait-mask"></div>

    <div class="wait-load">
        <div class="loader"></div>
    </div>
</div>

    <script src="/static/common/library/layui/layui.js"></script>
    <script src="/static/common/library/jquery.min.js"></script>
    <script src="/static/common/library/cache.min.js"></script>
    <script src="/static/backend/js/sortable.min.js"></script>
    <script src="/static/backend/js/config.min.js"></script>
    <script src="/static/backend/js/utils.min.js"></script>
    
<script src="/static/backend/js/kernel.min.js"></script>
<script>
    layui.use(function() {
        let $ = layui.$;

        waitUtil.event({
            info: function () {
                waitUtil.popup({
                    title: '基本信息',
                    url: '<?php echo route("auth.Admin/info"); ?>',
                    area: ['510px', '590px'],
                    success: function (layero, index) {
                        layero.layui.form.on('submit(addForm)', function(data){
                            data.field['id'] = '<?php echo htmlentities((string) app('request')->session('adminUser.id')); ?>';
                            waitUtil.ajax({
                                url: '<?php echo route("auth.admin/info"); ?>',
                                type: 'POST',
                                data: data.field
                            }).then((res) => {
                                if (res.code === 0) {
                                    layer.close(index);
                                    $('.wait-header .layui-nav-img').attr('src', data.field['avatar']);
                                }
                            });
                        });
                    }
                });
            },
            logout: function () {
                layer.confirm('您确定要退出系统吗?', function(index) {
                    layer.close(index);
                    waitUtil.ajax({
                        url: '<?php echo route("login/logout"); ?>',
                        type: 'POST',
                        data: []
                    }).then((res) => {
                        if (res.code === 0) {
                            location.href = '<?php echo route("login/index"); ?>';
                        }
                    });
                })
            }
        });
    });
</script>

</body>
</html>