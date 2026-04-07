<?php
declare (strict_types = 1);
 
namespace app\backend\service;

 
use app\common\basics\Service;
use app\common\model\Sailing;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;
 

/**
 * 船只航线服务类
 */
class SailingService extends Service
{
    /**
     * 船只航线列表
     *
     * @param array $get
     * @return array
     * @throws DbException
     * @author wait  
     */
    public static function lists(array $get): array
    {
        $lists = Sailing::withoutField(['update_time','delete_time'])
			->where(self::getWhere($get))
            ->order('id desc')
            ->paginate([
                'page'      => $get['page']  ?? 1,
                'list_rows' => $get['limit'] ?? 200,
                'var_page'  => 'page'
            ])->toArray();
 
        return ['count'=>$lists['total'], 'list'=>$lists['data']] ?? [];
    }
 
    /**
     * 船只航线详情
     *
     * @param int $id
     * @return array
     * @throws DataNotFoundException
     * @throws ModelNotFoundException
     * @author wait 
     */
    public static function detail(int $id): array
    {
        $model = new Sailing();
        return $model
            ->withoutField('delete_time')
            ->where(['id'=>$id])
            ->findOrFail()
            ->toArray();
    }
 
    /**
     * 船只航线新增
     *
     * @param array $post
     * @author wait  
     */
    public static function add(array $post): void
    {
        Sailing::create([
            'type' => $post['type'],
            'name' => $post['name'],
            'is_show' => $post['is_show'],
        ]);
    }
 
    /**
     * 船只航线编辑
     *
     * @param array $post
     * @author wait  
     */
    public static function edit(array $post): void
    {
        Sailing::update([
            'type' => $post['type'],
            'name' => $post['name'],
            'is_show' => $post['is_show'],
        ], ['id'=>intval($post['id'])]);
    }
 

    /**
     * 船只航线删除
     *
     * @param int $id
     * @author wait  
     */
    public static function del(int $id): void
    {
        Sailing::destroy($id);
    }
	
	
	public static function getWhere(array $get): array
    {
		$where 			= [];
		if(!empty($get['sailing_date'])){
			$time 		= is_array($get['sailing_date'])?$get['sailing_date']:explode('至',$get['sailing_date']);
			if(!empty($time[0])){
				$where[]= ['sailing_date', '>=', date('Y-m-d',strtotime(trim($time[0])))];
			}
			if(!empty($time[1])){
				$where[]= ['sailing_date', '<=', date('Y-m-d',strtotime(trim($time[1])))];
			}
		}
		return $where;
    }
	
	/**
     * 客户结款总数
     *
     * @param array $get
     * @return array
     * @throws DbException
     * @author zys
     */	
	public static function count(array $get)
    {
		return  Sailing::field('id')->where(self::getWhere($get))->count();
	}
	
	/**
     * 客户结款导出
     *
     * @param array $get
     * @return array
     * @throws DbException
     * @author zys
     */
	public static function export(array $get)
    {
		$data 			= self::lists($get)['list'];
		$fields			= [];
		$fields[]		= ['field'=>'push_time','name'=>'提交时间','width'=>''];
		$fields[]		= ['field'=>'remark','name'=>'船号','width'=>''];
		$fields[]		= ['field'=>'name','name'=>'航班名称','width'=>''];
		$fields[]		= ['field'=>'sailing_time','name'=>'班次','width'=>''];
		$fields[]		= ['field'=>'car_num','name'=>'车次','width'=>''];
		$fields[]		= ['field'=>'human_num','name'=>'人次','width'=>''];
		$fields[]		= ['field'=>'push_by','name'=>'船号','width'=>''];
		$fields[]		= ['field'=>'confirm_by','name'=>'确认人','width'=>''];
		$fields[]		= ['field'=>'confirm_time','name'=>'确认时间','width'=>''];
		$options		= [];
		return ['fields'=>$fields,'data'=>$data,'options'=>$options];
	}
	
	
	public static function dateStat(array $get): array
    {
        $lists = Sailing::withoutField(['update_time','delete_time'])
			->where(self::getWhere($get))->fieldRaw('id,sailing_date,sum(car_num) as car_num,sum(human_num) as human_num')
            ->order('sailing_date desc')->group('sailing_date')
            ->paginate([
                'page'      => $get['page']  ?? 1,
                'list_rows' => $get['limit'] ?? 20,
                'var_page'  => 'page'
            ])->toArray();
 
        return ['count'=>$lists['total'], 'list'=>$lists['data']] ?? [];
    }
	
	
	public static function countDateStat(array $get)
    {
		return  Sailing::field('id')->where(self::getWhere($get))->group('sailing_date')->count();
	}
	
	public static function exportDateStat(array $get)
    {
		$data 			= self::dateStat($get)['list'];
		$fields			= [];
		$fields[]		= ['field'=>'sailing_date','name'=>'日期','width'=>''];
		$fields[]		= ['field'=>'car_num','name'=>'车次','width'=>''];
		$fields[]		= ['field'=>'human_num','name'=>'人次','width'=>''];
		$options		= [];
		return ['fields'=>$fields,'data'=>$data,'options'=>$options];
	}
	
	
	
	public static function monthStat(array $get): array
    {
        $lists = Sailing::withoutField(['update_time','delete_time'])
			->where(self::getWhere($get))->fieldRaw('id,DATE_FORMAT(sailing_date, "%Y-%m") as sailing_date,sum(car_num) as car_num,sum(human_num) as human_num')
            ->order('sailing_date desc')->group("DATE_FORMAT(sailing_date, '%Y-%m')")
            ->paginate([
                'page'      => $get['page']  ?? 1,
                'list_rows' => $get['limit'] ?? 20,
                'var_page'  => 'page'
            ])->toArray();
 
        return ['count'=>$lists['total'], 'list'=>$lists['data']] ?? [];
    }
	
	
	public static function countMonthStat(array $get)
    {
		return  Sailing::field('id')->where(self::getWhere($get))->group("DATE_FORMAT(sailing_date, '%Y-%m')")->count();
	}
	
	public static function exportMonthStat(array $get)
    {
		$data 			= self::monthStat($get)['list'];
		$fields			= [];
		$fields[]		= ['field'=>'sailing_date','name'=>'月份','width'=>''];
		$fields[]		= ['field'=>'car_num','name'=>'车次','width'=>''];
		$fields[]		= ['field'=>'human_num','name'=>'人次','width'=>''];
		$options		= [];
		return ['fields'=>$fields,'data'=>$data,'options'=>$options];
	}
	
	public static function yearStat(array $get): array
    {
        $lists = Sailing::withoutField(['update_time','delete_time'])
			->where(self::getWhere($get))->fieldRaw('id,DATE_FORMAT(sailing_date, "%Y") as sailing_date,sum(car_num) as car_num,sum(human_num) as human_num')
            ->order('sailing_date desc')->group("DATE_FORMAT(sailing_date, '%Y')")
            ->paginate([
                'page'      => $get['page']  ?? 1,
                'list_rows' => $get['limit'] ?? 20,
                'var_page'  => 'page'
            ])->toArray();
 
        return ['count'=>$lists['total'], 'list'=>$lists['data']] ?? [];
    }
	
	
	public static function countYearStat(array $get)
    {
		return  Sailing::field('id')->where(self::getWhere($get))->group("DATE_FORMAT(sailing_date, '%Y')")->count();
	}
	
	public static function exportYearStat(array $get)
    {
		$data 			= self::yearStat($get)['list'];
		$fields			= [];
		$fields[]		= ['field'=>'sailing_date','name'=>'年份','width'=>''];
		$fields[]		= ['field'=>'car_num','name'=>'车次','width'=>''];
		$fields[]		= ['field'=>'human_num','name'=>'人次','width'=>''];
		$options		= [];
		return ['fields'=>$fields,'data'=>$data,'options'=>$options];
	}
	
	
}