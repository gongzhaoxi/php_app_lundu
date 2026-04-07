<?php /*a:2:{s:70:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/setting/watermark.html";i:1755524162;s:66:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/common/layout.html";i:1764860923;}*/ ?>
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
    .layui-form-label { width: 95px; }
    .layui-table { width: 415px; }
    @media screen and (max-width: 450px) {
        .layui-form-item .layui-input-inline {
            margin-left: 125px;
        }
        .layui-form-item .layui-input-inline+.layui-form-mid {
            margin-left: 125px;
        }
    }
    @media screen and (max-width: 600px) {
        .layui-form-mid {
            margin-left: 125px !important;
        }
    }
</style>

</head>
<body>
    
<div class="container">
    <div class="layui-form">
        <!-- 水印设置 -->
        <div class="layui-card">
            <div class="layui-card-header">水印设置</div>
            <div class="layui-card-body">
                <!-- 水印功能状态 -->
                <div class="layui-form-item">
                    <label for="statusOpen" class="layui-form-label">水印功能状态：</label>
                    <label for="statusClose" class="layui-hide"></label>
                    <div class="layui-input-block">
                        <input type="radio" id="statusOpen" name="status" value="1" title="开启" <?php if($detail['status']==1): ?>checked<?php endif; ?>>
                        <input type="radio" id="statusClose" name="status" value="0" title="关闭" <?php if($detail['status']==0): ?>checked<?php endif; ?>>
                    </div>
                </div>
                <!-- 水印文件类型 -->
                <div class="layui-form-item">
                    <label for="typeImage" class="layui-form-label">水印文件类型：</label>
                    <label for="typeText" class="layui-hide"></label>
                    <div class="layui-input-block">
                        <input type="radio" id="typeImage" name="type" value="image" title="图片" <?php if($detail['type']=='image'): ?>checked<?php endif; ?>>
                        <input type="radio" id="typeText" name="type" value="text" title="文字" <?php if($detail['type']=='text'): ?>checked<?php endif; ?>>
                    </div>
                </div>
                <!-- 水印图片文件 -->
                <div class="layui-form-item">
                    <label for="icon" class="layui-form-label">水印图片文件：</label>
                    <div class="layui-input-inline">
                        <div class="thumbnail" data-type="image">
                            <div class="musters">
                                <div class="preview <?php if(!$detail['icon']): ?>layui-hide<?php endif; ?>" style="width: 120px; height: 40px;">
                                    <input type="hidden" id="icon" name="icon" value="<?php echo htmlentities((string) $detail['icon']); ?>">
                                    <i class="layui-icon layui-icon-close"></i>
                                    <img src="<?php echo htmlentities((string) $detail['icon']); ?>" alt="img" class="previewImage">
                                </div>
                            </div>
                            <div class="builder layui-auto-call <?php if($detail['icon']): ?>layui-hide<?php endif; ?>" style="width: 120px; height: 40px;">
                                <p>上传图标</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 水印字体文字 -->
                <div class="layui-form-item">
                    <label for="fonts" class="layui-form-label">水印字体文字：</label>
                    <div class="layui-input-inline">
                        <input type="text" id="fonts" name="fonts" value="<?php echo htmlentities((string) $detail['fonts']); ?>" class="layui-input" autocomplete="off">
                    </div>
                    <div class="layui-form-mid layui-word-aux word-nowrap">开启文字水印时生效</div>
                </div>
                <!-- 水印字体大小 -->
                <div class="layui-form-item">
                    <label for="size" class="layui-form-label">水印字体大小：</label>
                    <div class="layui-input-inline">
                        <input type="number" id="size" name="size" value="<?php echo htmlentities((string) $detail['size']); ?>" class="layui-input" autocomplete="off">
                    </div>
                    <div class="layui-form-mid layui-word-aux word-nowrap">文字的大小, 示例值: 16</div>
                </div>
                <!-- 水印字体颜色 -->
                <div class="layui-form-item">
                    <label for="color" class="layui-form-label">水印字体颜色：</label>
                    <div class="layui-input-inline">
                        <input type="text" id="color" name="color" value="<?php echo htmlentities((string) $detail['color']); ?>" class="layui-input" autocomplete="off">
                    </div>
                    <div class="layui-form-mid layui-word-aux word-nowrap">文字的颜色, 默认值是#000000</div>
                </div>
                <!-- 水印字体偏移 -->
                <div class="layui-form-item">
                    <label for="offset" class="layui-form-label">水印字体偏移：</label>
                    <div class="layui-input-inline">
                        <input type="text" id="offset" name="offset" value="<?php echo htmlentities((string) $detail['offset']); ?>" class="layui-input" autocomplete="off">
                    </div>
                    <div class="layui-form-mid layui-word-aux word-nowrap">文字相对当前位置的偏移量(默认0)</div>
                </div>
                <!-- 水印字体倾斜 -->
                <div class="layui-form-item">
                    <label for="angle" class="layui-form-label">水印字体倾斜：</label>
                    <div class="layui-input-inline">
                        <input type="text" id="angle" name="angle" value="<?php echo htmlentities((string) $detail['angle']); ?>" class="layui-input" autocomplete="off">
                    </div>
                    <div class="layui-form-mid layui-word-aux word-nowrap">字体的倾斜角度，默认值是0</div>
                </div>
                <!-- 水印图透明度 -->
                <div class="layui-form-item">
                    <label for="alpha" class="layui-form-label">水印图透明度：</label>
                    <div class="layui-input-inline">
                        <input type="number" id="alpha" name="alpha" value="<?php echo htmlentities((string) $detail['alpha']); ?>" class="layui-input" autocomplete="off">
                    </div>
                    <div class="layui-form-mid layui-word-aux word-nowrap">透明度取值0~100，默认值是100</div>
                </div>
                <!-- 水印位置 -->
                <div class="layui-form-item">
                    <label class="layui-form-label">水印位置：</label>
                    <div class="layui-input-block" style="overflow-x: auto;">
                        <table class="layui-table">
                            <tbody>
                                <tr>
                                    <td><input type="radio" name="position" value="1" title="顶部居左" <?php if($detail['position']==1): ?>checked<?php endif; ?>></td>
                                    <td><input type="radio" name="position" value="2" title="顶部居中" <?php if($detail['position']==2): ?>checked<?php endif; ?>></td>
                                    <td><input type="radio" name="position" value="3" title="顶部居右" <?php if($detail['position']==3): ?>checked<?php endif; ?>></td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="position" value="4" title="左边居中" <?php if($detail['position']==4): ?>checked<?php endif; ?>></td>
                                    <td><input type="radio" name="position" value="5" title="图片中心" <?php if($detail['position']==5): ?>checked<?php endif; ?>></td>
                                    <td><input type="radio" name="position" value="6" title="右边居中" <?php if($detail['position']==6): ?>checked<?php endif; ?>></td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="position" value="7" title="底部居左" <?php if($detail['position']==7): ?>checked<?php endif; ?>></td>
                                    <td><input type="radio" name="position" value="8" title="底部居中" <?php if($detail['position']==8): ?>checked<?php endif; ?>></td>
                                    <td><input type="radio" name="position" value="9" title="底部居右" <?php if($detail['position']==9): ?>checked<?php endif; ?>></td>
                                </tr>
                            </tbody>
                        </table>
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
    layui.use(['form'], function () {
        let form = layui.form;

        // 提交表单
        form.on('submit(addForm)', function(data){
            layer.confirm('确定保存当前配置吗?', function(index) {
                layer.close(index);
                waitUtil.ajax({
                    url: '<?php echo route("setting.watermark/save"); ?>',
                    type: 'POST',
                    data: data.field
                });
            });
        });
    });
</script>

</body>
</html>