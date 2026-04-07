<?php
// +----------------------------------------------------------------------
// | WaitAdmin快速开发后台管理系统
// +----------------------------------------------------------------------
// | 欢迎阅读学习程序代码,建议反馈是我们前进的动力
// | 程序完全开源可支持商用,允许去除界面版权信息
// | gitee:   https://gitee.com/wafts/waitadmin-php
// | github:  https://github.com/topwait/waitadmin-php
// | 官方网站: https://www.waitadmin.cn
// | WaitAdmin团队版权所有并拥有最终解释权
// +----------------------------------------------------------------------
// | Author: WaitAdmin Team <2474369941@qq.com>
// +----------------------------------------------------------------------
 
 
namespace app\common\model;

 
use app\common\basics\Models;
use app\common\enums\SailingEnum;

/**
 * 船只航线模型
 */
class ShippingLine extends Models
{
    // 设置字段信息
    protected $schema = [
        'id' => 'string', //主键  
        'type' => 'integer', //进出类别  
        'name' => 'string', //航班名称  
        'is_show' => 'integer', //是否显示   
        'create_time' => 'string', //创建时间  
        'update_time' => 'string', //更新时间  
        'delete_time' => 'string', //删除时间  
    ];
	
	public function getTypeTextAttr($value,$data){
		
		return SailingEnum::getType($data['type']);
	}
}