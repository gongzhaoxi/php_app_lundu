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
 
namespace app\backend\controller;

 
use app\backend\service\ShippingLineService;
use app\backend\validate\ShippingLineValidate;
use app\backend\validate\PageValidate;
use app\common\basics\Backend;
use app\common\utils\AjaxUtils;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;
use think\response\Json;
use think\response\View;
use app\common\enums\SailingEnum;

/**
 * 船只航线管理
 */
class ShippingLineController extends Backend
{
    /**
     * 船只航线列表
     *
     * @return Json|View
     * @throws DbException
     * @author wait  
     */
    public function index(): View|Json
    {
        if ($this->isAjaxGet()) {
            (new PageValidate())->goCheck();
            $list = ShippingLineService::lists($this->request->get());
            return AjaxUtils::success($list);
        }
 
		return view('', [
			'type'		=> SailingEnum::getType(),
        ]);
    }
 
    /**
     * 船只航线新增
     *
     * @return Json|View
     * @author zero
     */
    public function add(): View|Json
    {
        if ($this->isAjaxPost()) {
            (new ShippingLineValidate())->addCheck();
            ShippingLineService::add($this->request->post());
            return AjaxUtils::success();
        }
 
		return view('', [
			'type'		=> SailingEnum::getType(),
        ]);
    }
 
    /**
     * 船只航线编辑
     *
     * @return Json|View
     * @throws DataNotFoundException
     * @throws ModelNotFoundException
     * @author zero
     */
    public function edit(): Json|View
    {
        if ($this->isAjaxPost()) {
            (new ShippingLineValidate())->editCheck();
            ShippingLineService::edit($this->request->post());
            return AjaxUtils::success();
        }
 
        (new ShippingLineValidate())->idCheck();
        $id = intval($this->request->get('id'));
 
        return view('', [
			'type'		=> SailingEnum::getType(),
            'detail'   	=> ShippingLineService::detail($id)
        ]);
    }
 
    /**
     * 船只航线删除
     *
     * @return Json
     * @author zero
     */
    public function del(): Json
    {
        if ($this->isAjaxPost()) {
            (new ShippingLineValidate())->idCheck();
            ShippingLineService::del(intval($this->request->post('id')));
            return AjaxUtils::success();
        }
 
        return AjaxUtils::error();
    }
}