<?php /*a:2:{s:70:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/sailing/date_stat.html";i:1764079164;s:66:"/www/wwwroot/lundu.ecloudm.com/app/backend/view/common/layout.html";i:1764860923;}*/ ?>
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
	 <div class="layui-card">
		<div class="layui-card-body" style="padding-bottom: 0;">
			<div class="layui-btn-container">
				<a  class="layui-btn layui-btn-sm" href="<?php echo url('index'); ?>">按班次统计</a> 
				<a  class="layui-btn  layui-btn-sm" href="<?php echo url('dateStat'); ?>">按日统计</a> 
				<a  class="layui-btn  layui-btn-sm" href="<?php echo url('monthStat'); ?>">按月统计</a> 
				<a  class="layui-btn  layui-btn-sm" href="<?php echo url('yearStat'); ?>">按年统计</a> 
			</div>
		</div>
	</div>
    <!-- 搜索栏 -->
    <form class="layui-form layui-search">
        <div class="layui-form-item">
            <div class="layui-inline">
                <label for="name" class="layui-form-label">日期：</label>
                <div class="layui-input-inline">
                    <input type="text" id="sailing_date" name="sailing_date"    class="layui-input" placeholder="请输入日期" autocomplete="off">
                </div>
            </div>
            <div class="layui-inline">
                <a class="layui-btn layui-btn-sm layui-btn-default" lay-submit lay-filter="search">查询</a>
                <a class="layui-btn layui-btn-sm layui-btn-primary" lay-submit lay-filter="clear-search">重置</a>
				<a class="layui-btn layui-btn-sm layui-btn-default export" >导出</a>
            </div>
        </div>
    </form>
    <!-- 表格栏 -->
    <div class="layui-card">
        <div class="layui-card-body">
            <table id="wait-table-list" lay-filter="wait-table-list"></table>
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
    layui.use(['laydate'],function() {
		layui.laydate.render({elem: '#sailing_date', type: 'date', range: '至',trigger: 'click'});
        // 渲染表格
        let table = waitUtil.table({
            elem: '#wait-table-list'
            ,url: '<?php echo route("Sailing/dateStat"); ?>'
			,toolbar:false
            ,defaultToolbar: false
			,height:'full-210'
            ,cols: [[
                {type:"numbers",title:'序号', width:60, align:'center'},
				{field:'sailing_date', title:'日期', align:'center'},
                {field:'car_num', title:'车次', align:'center'},
				{field:'human_num', title:'人次', align:'center'},
            ]]
        });
		
		$('.export').click(function(){
			exportData(layui.form.val('layui-search'),'<?php echo route("Sailing/exportDateStat"); ?>',10000);
		})
        // 逻辑事件
        waitUtil.event({


        });
        // 搜索事件
        waitUtil.search(table);
    });

</script>

</body>
</html>