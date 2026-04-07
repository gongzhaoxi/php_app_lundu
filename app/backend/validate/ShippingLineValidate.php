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
declare (strict_types = 1);
 
namespace app\backend\validate;

 
use app\common\basics\Validate;

/**
 * 船只航线参数验证器
 */
class ShippingLineValidate extends Validate
{
    protected $rule = [
        'id' => 'require|posInteger',
        'type' => 'require',
        'name' => 'require',
        'is_show' => 'require',
    ];
 
    public function __construct()
    {
        $this->field = [
            'id' => '主键',
            'type' => '进出类别',
            'name' => '航班名称',
            'is_show' => '是否显示',
        ];
 
        parent::__construct();
    }
}