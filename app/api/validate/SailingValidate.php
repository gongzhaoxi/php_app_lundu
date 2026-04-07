<?php
namespace app\api\validate;
use app\common\basics\Validate;

class SailingValidate extends Validate
{
	
	protected $rule = [
        'shipping_line_id' => 'require|number',
		'id' => 'require|number',
		'human_num' => 'require|number',
		'car_num' => 'require|number',
		'car_human_num' => 'require|number',
    ];

    public function __construct()
    {
        $this->field = [
            'shipping_line_id'   => '班次',
			'id'   => 'id',
        ];
        parent::__construct();
    }
	

    public function sceneCreate()
    {
        return $this->only(['shipping_line_id']);
    }
	
	public function sceneUpdate()
    {
        return $this->only(['shipping_line_id','id']);
    }
	
	public function scenePush()
    {
        return $this->only(['id','human_num','car_num','car_human_num']);
    }
	
	public function sceneConfirm()
    {
        return $this->only(['id','human_num','car_num']);
    }
  
}