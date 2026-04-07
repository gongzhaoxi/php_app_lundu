<?php /*a:2:{s:67:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/setting/basics.html";i:1755524162;s:66:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/common/layout.html";i:1764860923;}*/ ?>
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
        <!-- 基础设置 -->
        <div class="layui-card">
            <div class="layui-card-header">基础设置</div>
            <div class="layui-card-body">
                <!-- 版权信息 -->
                <div class="layui-form-item">
                    <label for="website_copyright" class="layui-form-label"><span class="asterisk">*</span>版权信息:</label>
                    <div class="layui-input-block">
                        <div class="layui-col-md4">
                            <input type="text" id="website_copyright" name="website_copyright"
                                   value="<?php echo htmlentities((string) $website['copyright']); ?>" class="layui-input" autocomplete="off">
                        </div>
                    </div>
                </div>
                <!-- ICP备案 -->
                <div class="layui-form-item">
                    <label for="website_icp" class="layui-form-label"><span class="asterisk">*</span>ICP备案:</label>
                    <div class="layui-input-block">
                        <div class="layui-col-md4">
                            <input type="text" id="website_icp" name="website_icp"
                                   value="<?php echo htmlentities((string) $website['icp']); ?>" class="layui-input" autocomplete="off">
                        </div>
                    </div>
                </div>
                <!-- 公安备案 -->
                <div class="layui-form-item">
                    <label for="website_pcp" class="layui-form-label">公安备案:</label>
                    <div class="layui-input-block">
                        <div class="layui-col-md4">
                            <input type="text" id="website_pcp" name="website_pcp"
                                   value="<?php echo htmlentities((string) $website['pcp']); ?>" class="layui-input" autocomplete="off">
                        </div>
                    </div>
                </div>
                <!-- 统计代码 -->
                <div class="layui-form-item">
                    <label for="website_analyse" class="layui-form-label">统计代码:</label>
                    <div class="layui-input-block">
                        <div class="layui-col-md4">
                            <textarea id="website_analyse" name="website_analyse"
                                      class="layui-textarea" autocomplete="off"><?php echo htmlentities((string) $website['analyse']); ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- H5端设置 -->
        <div class="layui-card">
            <div class="layui-card-header">H5端设置</div>
            <div class="layui-card-body">
                <!-- H5端logo -->
                <div class="layui-form-item">
                    <div class="layui-form-label"><span class="asterisk">*</span>H5端logo:</div>
                    <div class="layui-input-block">
                        <div class="layui-col-md4">
                            <div class="thumbnail" data-type="image" data-field="h5_logo" data-limit="1">
                                <div class="musters">
                                    <?php if($h5['logo']): ?>
                                        <div class="preview">
                                            <input type="hidden" id="h5_logo" name="h5_logo" value="<?php echo htmlentities((string) $h5['logo']); ?>">
                                            <i class="layui-icon layui-icon-close"></i>
                                            <img src="<?php echo htmlentities((string) $h5['logo']); ?>" alt="img" class="previewImage">
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="builder layui-auto <?php if($h5['logo']): ?>layui-hide<?php endif; ?>">
                                    <i class="layui-icon layui-icon-camera"></i>
                                    <p>上传图标</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- H5端标题 -->
                <div class="layui-form-item">
                    <label for="h5_title" class="layui-form-label"><span class="asterisk">*</span>H5端标题:</label>
                    <div class="layui-input-block">
                        <div class="layui-col-md4">
                            <input type="text" id="h5_title" name="h5_title"
                                   value="<?php echo htmlentities((string) $h5['title']); ?>" class="layui-input" autocomplete="off">
                        </div>
                    </div>
                </div>
                <!-- 站点状态 -->
                <div class="layui-form-item">
                    <div class="layui-form-label"><span class="asterisk">*</span>站点状态：</div>
                    <div class="layui-input-block">
                        <div class="layui-col-md4">
                            <input type="radio" name="h5_status" value="1" title="开启" <?php if($h5['status']==1): ?>checked<?php endif; ?> lay-filter="h5_status">
                            <input type="radio" name="h5_status" value="0" title="关闭" <?php if($h5['status']==0): ?>checked<?php endif; ?> lay-filter="h5_status">
                        </div>
                    </div>
                </div>
                <!-- 关闭页面 -->
                <div class="layui-form-item h5_status" <?php if($h5['status']==1): ?>style="display:none;"<?php endif; ?>>
                    <label for="h5_close_url" class="layui-form-label" lay-tips="站点关闭后访问的页面路径">
                        <span class="asterisk">*</span>关闭页面：
                    </label>
                    <div class="layui-input-block">
                        <div class="layui-col-md4">
                            <input type="text" id="h5_close_url" name="h5_close_url" placeholder="关闭后显示的页面链接"
                                   value="<?php echo htmlentities((string) $h5['close_url']); ?>" class="layui-input" autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- PC端设置 -->
        <div class="layui-card">
            <div class="layui-card-header">电脑端设置</div>
            <div class="layui-card-body">
                <!-- 网站标题 -->
                <div class="layui-form-item">
                    <label for="pc_title" class="layui-form-label"><span class="asterisk">*</span>网站标题:</label>
                    <div class="layui-input-block">
                        <div class="layui-col-md4">
                            <input type="text" id="pc_title" name="pc_title"
                                   value="<?php echo htmlentities((string) $pc['title']); ?>" class="layui-input" autocomplete="off">
                        </div>
                    </div>
                </div>
                <!-- 关键词组 -->
                <div class="layui-form-item">
                    <label for="pc_keywords" class="layui-form-label"><span class="asterisk">*</span>关键词组:</label>
                    <div class="layui-input-block">
                        <div class="layui-col-md4">
                            <input type="text" id="pc_keywords" name="pc_keywords"
                                   value="<?php echo htmlentities((string) $pc['keywords']); ?>" class="layui-input" autocomplete="off">
                        </div>
                    </div>
                </div>
                <!-- 网站描述 -->
                <div class="layui-form-item">
                    <label for="pc_description" class="layui-form-label"><span class="asterisk">*</span>网站描述:</label>
                    <div class="layui-input-block">
                        <div class="layui-col-md4">
                             <textarea id="pc_description" name="pc_description"
                                       class="layui-textarea" autocomplete="off"><?php echo htmlentities((string) $pc['description']); ?></textarea>
                        </div>
                    </div>
                </div>
                <!-- 网站logo -->
                <div class="layui-form-item">
                    <div class="layui-form-label"><span class="asterisk">*</span>网站logo:</div>
                    <div class="layui-input-block">
                        <div class="layui-col-md4">
                            <div class="layui-col-md4">
                                <div class="thumbnail" data-type="image" data-field="pc_logo" data-limit="1">
                                    <div class="musters">
                                        <?php if($pc['logo']): ?>
                                            <div class="preview">
                                                <input type="hidden" id="pc_logo" name="pc_logo" value="<?php echo htmlentities((string) $pc['logo']); ?>">
                                                <i class="layui-icon layui-icon-close"></i>
                                                <img src="<?php echo htmlentities((string) $pc['logo']); ?>" alt="img" class="previewImage">
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="builder layui-auto <?php if($pc['logo']): ?>layui-hide<?php endif; ?>">
                                        <i class="layui-icon layui-icon-camera"></i>
                                        <p>上传图标</p>
                                    </div>
                                </div>
                            </div>
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
        let $ = layui.$;

        form.on('submit(addForm)', function(data) {
            let that = this;
            waitUtil.locking(that)
            layer.confirm('确定保存当前配置吗?', function (index) {
                waitUtil.unlock(that);
                layer.close(index);
                waitUtil.ajax({
                    url: '<?php echo route("setting.basics/save"); ?>',
                    type: "POST",
                    data: data.field
                });
            });
        });

        form.on('radio(h5_status)', function (data) {
            let node = $('.h5_status');
            if (parseInt(data.value ) === 1) {
                node.hide();
            } else {
                node.show();
            }
        });
    });
</script>

</body>
</html>