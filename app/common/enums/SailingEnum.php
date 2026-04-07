<?php
namespace app\common\enums;


class SailingEnum
{
    const TYPE_ENTER = 0;
    const TYPE_OUT = 1; 
    const CATEGORY_HUMAN = 1;
    const CATEGORY_CAR = 2; 
	const STATUS_0 = 0; 
	const STATUS_1 = 1; 
	const STATUS_2 = 2; 

    public static function getType($code=true): string | array
    {
        $desc = [
            self::TYPE_ENTER => '进岛',
            self::TYPE_OUT => '出岛'
        ];
		if($code === true){
			return $desc ;
		}
        return $desc[$code] ?? '未知';
    }
	
    public static function getCategory($code=true): string | array
    {
        $desc = [
			self::CATEGORY_HUMAN 	=> '人员识别',
			self::CATEGORY_CAR 		=> '车辆识别'
        ];
		if($code === true){
			return $desc ;
		}
        return $desc[$code] ?? '未知';
    }	
	
	public static function getStatus($code=true): string | array
    {
        $desc = [
			self::STATUS_0 	=> '未确认',
			self::STATUS_1 	=> '待确认',
			self::STATUS_2 	=> '已确认'
        ];
		if($code === true){
			return $desc ;
		}
        return $desc[$code] ?? '未知';
    }	
}