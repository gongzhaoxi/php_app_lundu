<?php

namespace app\common\model;

 
use app\common\basics\Models;
use app\common\enums\SailingEnum;

class SailingHuman extends Models
{
	
	public function getTypeTextAttr($value,$data){
		
		return SailingEnum::getType($data['type']);
	}
	
		

}