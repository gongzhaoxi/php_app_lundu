<?php
// +----------------------------------------------------------------------
// | WaitAdmin快速开发后台管理系统
// +----------------------------------------------------------------------
// | 欢迎阅读学习程序代码,建议反馈是我们前进的动力
// | 程序完全开源可支持商用,允许去除界面版权信息
// | gitee:   https://gitee.com/wafts/waitadmin-php
// | github:  https://github.com/topwait/waitadmin-php
// | 官方网站: https://www.waitadmin.cn
// | WaitAdmin团队版权所有并拥有最终解释权
// +----------------------------------------------------------------------
// | Author: WaitAdmin Team <2474369941@qq.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace app\backend\controller;

use app\backend\service\IndexService;
use app\common\basics\Backend;
use app\common\utils\ArrayUtils;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;
use think\response\View;
use app\backend\service\SailingService;
use app\common\utils\AjaxUtils;
use think\response\Json;
use app\common\utils\ConfigUtils;
use app\common\utils\UrlUtils;
/**
 * 主页管理
 */
class IndexController extends Backend
{
    protected array $notNeedPower = ['setting','board'];
    protected array $notNeedLogin = ['board'];

    /**
     * 主页
     *
     * @return View
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     * @method [GET]
     * @author zero
     */
    public function index(): View
    {
        $detail = IndexService::index($this->adminId, intval($this->adminUser['role_id']));
        return view('index', [
            'menus'     => ArrayUtils::toTreeJson($detail['menus']),
            'config'    => $detail['config'],
            'adminUser' => $detail['adminUser'],
            'logo'		=> UrlUtils::toAbsoluteUrl(strval(ConfigUtils::get('pc','logo')??''))
        ]);
    }

    /**
     * 控制台
     *
     * @return View
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     * @method [GET]
     * @author zero
     */
    public function console(): View
    {
        return view('', [
            
        ]);
    }

    /**
     * 设置弹窗
     *
     * @return View
     * @method [GET]
     * @author zero
     */
    public function setting(): View
    {
        return view();
    }
	
    public function board(): View | Json
    {
		if($this->request->isAjax()){
			$list = SailingService::lists($this->request->get());
            return AjaxUtils::success($list);
		}else{
			return view('',[
				'weather'=>\app\api\service\SailingService::getWeather()
			]);
		}
    }	
	
}