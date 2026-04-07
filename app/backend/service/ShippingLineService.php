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
 
namespace app\backend\service;

 
use app\common\basics\Service;
use app\common\model\ShippingLine;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;
 

/**
 * 船只航线服务类
 */
class ShippingLineService extends Service
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
        self::setSearch([
            '=' => ['type','is_show'],
            '%like%' => ['name'],
        ]);
 
        $model = new ShippingLine();
        $lists = $model
            ->withoutField(['update_time','delete_time'])
            ->where(self::$searchWhere)->append(['type_text'])
            ->order('id desc')
            ->paginate([
                'page'      => $get['page']  ?? 1,
                'list_rows' => $get['limit'] ?? 20,
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
        $model = new ShippingLine();
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
        ShippingLine::create([
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
        ShippingLine::update([
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
        ShippingLine::destroy($id);
    }
}