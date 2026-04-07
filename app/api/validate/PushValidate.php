<?php
namespace app\api\validate;
use app\common\basics\Validate;

class PushValidate extends Validate
{
	
	protected $rule = [
        'deviceId' 		=> 'require',
		'timestamp' 	=> 'require',
		'currentEnters' => 'require',
		'deviceName' 	=> 'require',
    ];

    public function __construct()
    {
        $this->field = [
            'deviceId'		=> '设备序列号',
			'timestamp'  	=> '时间戳',
			'currentEnters'	=> '当前进入总人数',
			'deviceName'	=> '设备序列号',
        ];
        parent::__construct();
    }
	

    public function sceneHuman()
    {
        return $this->only(['deviceId','timestamp','currentEnters']);
    }
	
	public function sceneCar()
    {
        return $this->only(['deviceName']);
    }
  
}