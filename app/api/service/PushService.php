<?php
declare (strict_types = 1);

namespace app\api\service;

use app\common\basics\Service;
use app\common\model\SailingHuman;
use app\common\model\SailingCar;
use app\common\model\Device;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;
use app\common\exception\OperateException;


class PushService extends Service
{

    public static function human(array $post): bool 
    {
		$device = Device::where('sn',$post['deviceId'])->find();
		if(empty($device['id'])) {
			throw new OperateException('设备错误');
        }
		if(empty($post['currentEnters'])){
			return false;
		}
		$model = SailingHuman::create(['type'=>$device['type'],'device_sn'=>$device['sn'],'timestamp'=>$post['timestamp'],'current_enters'=>$post['currentEnters']]);
        return true;
    }	


    public static function car(array $post): bool 
    {
		$device = Device::where('sn',$post['deviceName'])->find();
		if(empty($device['id'])) {
			throw new OperateException('设备错误');
        }
		$model = SailingCar::create(['type'=>$device['type'],'device_sn'=>$device['sn'],'num'=>1,'license'=>$post['result']['PlateResult']['license']??'']);
        return true;
    }
   
}