<?php
declare (strict_types = 1);

namespace app\api\controller;

use app\api\service\PushService;
use app\common\basics\Api;
use app\common\utils\AjaxUtils;
use think\response\Json;
use app\api\validate\PushValidate;
use think\facade\Log;

/**
 * 推送管理
 */
class PushController extends Api
{
    protected array $notNeedLogin = ['human', 'car'];

    public function human(): Json
    {
		$jsonData = json_decode(file_get_contents('php://input'), true); 
		//Log::info('人数推送数据(php://input):'.json_encode($jsonData));
		if(empty($jsonData)){
			$jsonData = $this->request->post();
			//Log::info('人数推送数据(post):'.json_encode($jsonData));
		}
		(new PushValidate())->goCheck('human');
        PushService::human($this->request->post());
        return AjaxUtils::success();
    }

    public function car(): Json
    {
		$jsonData = json_decode(file_get_contents('php://input'), true); 
		//Log::info('车数推送数据(php://input):'.json_encode($jsonData));
		if(empty($jsonData)){
			$jsonData = $this->request->post();
			//Log::info('车数推送数据(post):'.json_encode($jsonData));
		}
		(new PushValidate())->goCheck('car',$jsonData['AlarmInfoPlate']);
		PushService::car($jsonData['AlarmInfoPlate']);
        return AjaxUtils::success();
    }
}