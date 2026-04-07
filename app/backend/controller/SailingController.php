<?php
declare (strict_types = 1);
 
namespace app\backend\controller;

 
use app\backend\service\SailingService;
use app\backend\validate\SailingValidate;
use app\backend\validate\PageValidate;
use app\common\basics\Backend;
use app\common\utils\AjaxUtils;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;
use think\response\Json;
use think\response\View;
use app\common\enums\SailingEnum;
use app\common\service\excel\ExcelDriver;
use app\common\utils\FileUtils;
use app\common\utils\ZipUtils;

/**
 * 船只航线管理
 */
class SailingController extends Backend
{
	
	protected array $notNeedPower = ['export','exportDateStat','exportMonthStat','exportYearStat'];	
	
    /**
     * 船只航线列表
     *
     * @return Json|View
     * @throws DbException
     * @author wait  
     */
    public function index(): View|Json
    {
        if ($this->isAjaxGet()) {
            (new PageValidate())->goCheck();
            $list = SailingService::lists($this->request->get());
            return AjaxUtils::success($list);
        }
 
		return view('', [
			'date'=>date('Y-m-01').' 至 '.date('Y-m-d')
        ]);
    }
 
    /**
     * 船只航线新增
     *
     * @return Json|View
     * @author zero
     */
    public function add(): View|Json
    {
        if ($this->isAjaxPost()) {
            (new SailingValidate())->addCheck();
            SailingService::add($this->request->post());
            return AjaxUtils::success();
        }
 
		return view('', [
			'type'		=> SailingEnum::getType(),
        ]);
    }
 
    /**
     * 船只航线编辑
     *
     * @return Json|View
     * @throws DataNotFoundException
     * @throws ModelNotFoundException
     * @author zero
     */
    public function edit(): Json|View
    {
        if ($this->isAjaxPost()) {
            (new SailingValidate())->editCheck();
            SailingService::edit($this->request->post());
            return AjaxUtils::success();
        }
 
        (new SailingValidate())->idCheck();
        $id = intval($this->request->get('id'));
 
        return view('', [
			'type'		=> SailingEnum::getType(),
            'detail'   	=> SailingService::detail($id)
        ]);
    }
 
    /**
     * 船只航线删除
     *
     * @return Json
     * @author zero
     */
    public function del(): Json
    {
        if ($this->isAjaxPost()) {
            (new SailingValidate())->idCheck();
            SailingService::del(intval($this->request->post('id')));
            return AjaxUtils::success();
        }
 
        return AjaxUtils::error();
    }
	
	
	
	/**
     * 导出
     *
     * @return Json
     * @method [POST]
     * @author zys
     */	
	public function export(){
		ini_set("memory_limit","-1");
		ini_set('max_execution_time', '60');
		$key 			= preg_replace( '/[\W]/', '', $this->request->param('key',''));
		$export_act		= $this->request->param('export_act',0);
		if($export_act == 1){
			return AjaxUtils::success(['count'=>SailingService::count($this->request->param()),'key'=>make_rand_char(24)]);
		}else if($export_act == 2 && $key){
			$page 		= $this->request->param('page');
			$data 		= SailingService::export($this->request->param());
			$dir 		= './download/'.$key.'/';
			FileUtils::mkdir($dir);
			$data['options']['exportMethod'] 	= 'path';
			$data['options']['exportPath'] 		= $dir;
			$data['options']['exportName'] 		= $page;
			ExcelDriver::export($data['fields'],$data['data'],$data['options']);
			return AjaxUtils::success();
		}else if($export_act == 3 && $key && is_dir('./download/'.$key)){
			ZipUtils::zip('./download/'.$key,'./download/'.$key.'.zip');
			return json(['path'=>'/download/'.$key.'.zip']);
		}else{
			$data 		= SailingService::export($this->request->param());
			$data['options']['exportName'] 		= '航班人车次汇总(按班次)';
			ExcelDriver::export( $data['fields'], $data['data'], $data['options']);
			exit;
		}
    }
	
	public function dateStat(): View|Json
    {
        if ($this->isAjaxGet()) {
            (new PageValidate())->goCheck();
            $list = SailingService::dateStat($this->request->get());
            return AjaxUtils::success($list);
        }
 
		return view('', [
			
        ]);
    }
	
	public function exportDateStat(){
		ini_set("memory_limit","-1");
		ini_set('max_execution_time', '60');
		$key 			= preg_replace( '/[\W]/', '', $this->request->param('key',''));
		$export_act		= $this->request->param('export_act',0);
		if($export_act == 1){
			return AjaxUtils::success(['count'=>SailingService::countDateStat($this->request->param()),'key'=>make_rand_char(24)]);
		}else if($export_act == 2 && $key){
			$page 		= $this->request->param('page');
			$data 		= SailingService::exportDateStat($this->request->param());
			$dir 		= './download/'.$key.'/';
			FileUtils::mkdir($dir);
			$data['options']['exportMethod'] 	= 'path';
			$data['options']['exportPath'] 		= $dir;
			$data['options']['exportName'] 		= $page;
			ExcelDriver::export($data['fields'],$data['data'],$data['options']);
			return AjaxUtils::success();
		}else if($export_act == 3 && $key && is_dir('./download/'.$key)){
			ZipUtils::zip('./download/'.$key,'./download/'.$key.'.zip');
			return json(['path'=>'/download/'.$key.'.zip']);
		}else{
			$data 		= SailingService::exportDateStat($this->request->param());
			$data['options']['exportName'] 		= '航班人车次汇总(按日)';
			ExcelDriver::export( $data['fields'], $data['data'], $data['options']);
			exit;
		}
    }
	

	public function monthStat(): View|Json
    {
        if ($this->isAjaxGet()) {
            (new PageValidate())->goCheck();
            $list = SailingService::monthStat($this->request->get());
            return AjaxUtils::success($list);
        }
 
		return view('', [
			
        ]);
    }
	
	public function exportMonthStat(){
		ini_set("memory_limit","-1");
		ini_set('max_execution_time', '60');
		$key 			= preg_replace( '/[\W]/', '', $this->request->param('key',''));
		$export_act		= $this->request->param('export_act',0);
		if($export_act == 1){
			return AjaxUtils::success(['count'=>SailingService::countMonthStat($this->request->param()),'key'=>make_rand_char(24)]);
		}else if($export_act == 2 && $key){
			$page 		= $this->request->param('page');
			$data 		= SailingService::exportMonthStat($this->request->param());
			$dir 		= './download/'.$key.'/';
			FileUtils::mkdir($dir);
			$data['options']['exportMethod'] 	= 'path';
			$data['options']['exportPath'] 		= $dir;
			$data['options']['exportName'] 		= $page;
			ExcelDriver::export($data['fields'],$data['data'],$data['options']);
			return AjaxUtils::success();
		}else if($export_act == 3 && $key && is_dir('./download/'.$key)){
			ZipUtils::zip('./download/'.$key,'./download/'.$key.'.zip');
			return json(['path'=>'/download/'.$key.'.zip']);
		}else{
			$data 		= SailingService::exportMonthStat($this->request->param());
			$data['options']['exportName'] 		= '航班人车次汇总(按月)';
			ExcelDriver::export( $data['fields'], $data['data'], $data['options']);
			exit;
		}
    }	
	

	public function yearStat(): View|Json
    {
        if ($this->isAjaxGet()) {
            (new PageValidate())->goCheck();
            $list = SailingService::yearStat($this->request->get());
            return AjaxUtils::success($list);
        }
 
		return view('', [
			
        ]);
    }
	
	
	public function exportYearStat(){
		ini_set("memory_limit","-1");
		ini_set('max_execution_time', '60');
		$key 			= preg_replace( '/[\W]/', '', $this->request->param('key',''));
		$export_act		= $this->request->param('export_act',0);
		if($export_act == 1){
			return AjaxUtils::success(['count'=>SailingService::countYearStat($this->request->param()),'key'=>make_rand_char(24)]);
		}else if($export_act == 2 && $key){
			$page 		= $this->request->param('page');
			$data 		= SailingService::exportYearStat($this->request->param());
			$dir 		= './download/'.$key.'/';
			FileUtils::mkdir($dir);
			$data['options']['exportMethod'] 	= 'path';
			$data['options']['exportPath'] 		= $dir;
			$data['options']['exportName'] 		= $page;
			ExcelDriver::export($data['fields'],$data['data'],$data['options']);
			return AjaxUtils::success();
		}else if($export_act == 3 && $key && is_dir('./download/'.$key)){
			ZipUtils::zip('./download/'.$key,'./download/'.$key.'.zip');
			return json(['path'=>'/download/'.$key.'.zip']);
		}else{
			$data 		= SailingService::exportYearStat($this->request->param());
			$data['options']['exportName'] 		= '航班人车次汇总(按年)';
			ExcelDriver::export( $data['fields'], $data['data'], $data['options']);
			exit;
		}
    }
	
}