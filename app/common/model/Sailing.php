<?php

namespace app\common\model;

 
use app\common\basics\Models;
use app\common\enums\SailingEnum;
/**
 * 班次模型
 */
class Sailing extends Models
{
	protected $append = ['sailing_time','status_text','human_total_num'];
	
	public function getTypeTextAttr($value,$data){
		
		return SailingEnum::getType($data['type']);
	}
	
	public function getCategoryTextAttr($value,$data){
		
		return SailingEnum::getCategory($data['category']);
	}
	
	public function getStatusTextAttr($value,$data){
		
		return SailingEnum::getStatus($data['status']);
	}	
	
	public function getSailingTimeAttr($value,$data){
		if(!empty($data['confirm_time'])){
			return date('H:i',$data['confirm_time']);
		}
		return '';
	}
	
	public function getHumanTotalNumAttr($value,$data){
		
		return $data['car_human_num'] + $data['human_num'];
	}
	
	public function getPushTimeAttr($value,$data){
		if(!empty($value)){
			return date('Y-m-d H:i:s',$value);
		}
		return '';
	}
	public function getConfirmTimeAttr($value,$data){
		if(!empty($value)){
			return date('Y-m-d H:i:s',$value);
		}
		return '';
	}
	
}