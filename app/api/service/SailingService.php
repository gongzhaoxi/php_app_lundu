<?php
declare (strict_types = 1);

namespace app\api\service;

use app\common\basics\Service;
use app\common\model\Sailing;
use app\common\model\ShippingLine;
use app\common\model\Device;
use app\common\model\SailingHuman;
use app\common\model\SailingCar;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;
use app\common\exception\OperateException;
use app\common\enums\SailingEnum;
use think\facade\Log;


class SailingService extends Service
{

    public static function shippingLine(): array
    {
		$lists = ShippingLine::field(['id,name'])->where(['is_show'=>1])->select()->toArray();
        return $lists;
    }
	
    public static function create(array $post,int $user_id): bool 
    {
		$shippingLine = ShippingLine::where('id',$post['shipping_line_id'])->find();
		if (empty($shippingLine['id'])) {
			throw new OperateException('班次错误');
        }
		$user = UserService::info($user_id);
		$model = Sailing::create(['sailing_date'=>date('Y-m-d'),'user_id'=>$user_id,'remark'=>$post['remark']??'','create_by'=>$user['nickname'],'shipping_line_id'=>$shippingLine['id'],'name'=>$shippingLine['name'],'type'=>$shippingLine['type']]);
        return true;
    }	
	
    public static function lists(array $get): array
    {
        $where = [];
        if (!empty($get['sailing_date'])) {
            $where[] = ['sailing_date', '=', $get['sailing_date']];
        }
	    if (isset($get['status']) && $get['status'] !== '') {
            $where[] = ['status', '=', (int)$get['status']];
        }
        return Sailing::field(['id,sailing_date,name,type,create_time,human_num,car_num,confirm_time,status,car_human_num,remark'])
            ->where($where)
            ->order('id desc')
            ->paginate([
                'page'      => $get['pageNo']  ?? 1,
                'list_rows' => $get['limit'] ?? 20,
                'var_page'  => 'page'
            ])->toArray();
    }

	public static function getWeather(){
		$cache_data = cache('day_weather');
		$cache_data = $cache_data?$cache_data:[];
		$date = date('Y-m-d');
		if(empty($cache_data[$date])){
			$content = json_decode(file_get_contents('https://cn.apihz.cn/api/tianqi/tengxun.php?id=88888888&key=88888888&province=广东省&city=佛山市&county=南海区'),true);
			$cache_data = [];
			if(!empty($content['data'])){
				foreach($content['data'] as $vo){
					$cache_data[$vo['time']] = $vo['day_weather'];
				}
				cache('day_weather',$cache_data);
			}

		}
		return $cache_data[$date]??'';
	}


    public static function detail(int $id): array
    {
		$model = Sailing::field('*')->where(['id'=>$id])->findOrFail()->toArray();
		$model['weather'] = $model['weather']?$model['weather']:self::getWeather();
		//if($model['push_time']){
			//$model['push_time'] = date('Y-m-d H:i:s',$model['push_time']);
		//}
		//if($model['confirm_time']){
			//$model['confirm_time'] = date('Y-m-d H:i:s',$model['confirm_time']);
		//}
        return $model;
    }
	
	public static function update(array $post,int $user_id): bool 
    {
		$mode = Sailing::where(['id'=>$post['id']])->findOrFail();
		$shippingLine = ShippingLine::where('id',$post['shipping_line_id'])->find();
		if (empty($shippingLine['id'])) {
			throw new OperateException('班次错误');
        }
		if($mode['status'] != 0){
			throw new OperateException('状态错误');
		}
		$mode->save(['shipping_line_id'=>$shippingLine['id'],'name'=>$shippingLine['name'],'type'=>$shippingLine['type']]);
        return true;
    }	
	
	
    public static function params(): array
    {
		$data = [];
		$status = SailingEnum::getStatus();
		$data['status'] = [['label'=>'全部','value'=>'']];
		foreach($status as $k=>$v){
			$data['status'][] = ['label'=>$v,'value'=>$k];
		}
        return $data;
    }	
	
    public static function flow($id): array
    {
		$mode = Sailing::where(['id'=>$id])->findOrFail();
		if(empty($mode['id'])) {
			throw new OperateException('班次错误');
        }
		$today = strtotime(date('Y-m-d'));
		$lastTime = Sailing::where('type',$mode['type'])->max('push_time');
		$lastTime = $lastTime?$lastTime:0;
		$lastCurrentEnters 	= array_sum(array_column(SailingHuman::where('timestamp','>',$today)->where('timestamp','<=',$lastTime)->where('type',$mode['type'])->fieldRaw('id,device_sn,MAX(current_enters) AS current_enters')->group('device_sn')->select()->toArray(), 'current_enters'));
		Log::info('人数统计:'.json_encode($lastCurrentEnters));
		//return [];
		$data 				= [];
		$data['human_num'] 	= array_sum(array_column(SailingHuman::where('timestamp','>',$today)->where('type',$mode['type'])->fieldRaw('id,device_sn,MAX(current_enters) AS current_enters')->group('device_sn')->select()->toArray(), 'current_enters')) - $lastCurrentEnters;
		$data['car_num'] 	= SailingCar::where('create_time','>',$lastTime)->where('type',$mode['type'])->count();
        return $data;
    }	
	
	public static function push(array $post,int $user_id): bool 
    {
		$mode = Sailing::where(['id'=>$post['id']])->findOrFail();
		if($mode['status'] != 0 && $mode['status'] != 1){
			throw new OperateException('状态错误');
		}
		$user = UserService::info($user_id);
		$data = ['status'=>1,'remark'=>$post['remark']??'','weather'=>$post['weather']??'','human_num'=>$post['human_num'],'car_num'=>$post['car_num'],'car_human_num'=>$post['car_human_num']];
		if($mode['status'] == 0){
			$data['push_time'] = time();
			$data['push_by'] = $user['nickname'];
		}
		$mode->save($data);
        return true;
    }	
	
	
   	public static function confirm(array $post,int $user_id): bool 
    {
		$mode = Sailing::where(['id'=>$post['id']])->findOrFail();
		if($mode['status'] != 1){
			throw new OperateException('状态错误');
		}
		$user = UserService::info($user_id);
		$mode->save(['status'=>2,'confirm_time'=>time(),'confirm_by'=>$user['nickname'],'remark'=>$post['remark']??'','weather'=>$post['weather']??'','human_num'=>$post['human_num'],'car_num'=>$post['car_num'],'car_human_num'=>$post['car_human_num']]);
        return true;
    }	
	
}