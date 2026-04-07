<?php
declare (strict_types = 1);

namespace app\backend\controller;

use app\backend\service\IndexService;
use app\common\basics\Backend;
use app\common\utils\ArrayUtils;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;
use think\response\View;


class BoardController extends Backend
{
    protected array $notNeedPower = ['index'];

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

        return view('index', [
           
        ]);
    }

    
}