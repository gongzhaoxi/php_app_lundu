<?php
declare (strict_types = 1);

namespace app\api\controller;

use app\api\service\SailingService;
use app\common\basics\Api;
use app\common\utils\AjaxUtils;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;
use think\response\Json;
use app\api\validate\SailingValidate;
use app\api\validate\IDMustValidate;


class SailingController extends Api
{
    protected array $notNeedLogin = [];

    public function shippingLine(): Json
    {
        $list = SailingService::shippingLine();
        return AjaxUtils::success($list);
    }

    public function create(): Json
    {
        (new SailingValidate())->goCheck('create');
        SailingService::create($this->request->post(), $this->userId);
        return AjaxUtils::success();
    }
	
	
    public function lists(): Json
    {
        $list = SailingService::lists($this->request->get());
        return AjaxUtils::success($list);
    }

    public function detail(): Json
    {
        (new IDMustValidate())->goCheck();
        $id = intval($this->request->get('id'));
        $detail = SailingService::detail($id);
        return AjaxUtils::success($detail);
    }
	
	public function update(): Json
    {
        (new SailingValidate())->goCheck('update');
        SailingService::update($this->request->post(), $this->userId);
        return AjaxUtils::success();
    }
	
    public function params(): Json
    {
        $list = SailingService::params();
        return AjaxUtils::success($list);
    }
	
    public function flow(): Json
    {
        $list = SailingService::flow($this->request->get('id'));
        return AjaxUtils::success($list);
    }	
	
	
	public function push(): Json
    {
        (new SailingValidate())->goCheck('push');
        SailingService::push($this->request->post(), $this->userId);
        return AjaxUtils::success();
    }
	
	public function confirm(): Json
    {
        (new SailingValidate())->goCheck('confirm');
        SailingService::confirm($this->request->post(), $this->userId);
        return AjaxUtils::success();
    }	
	
}