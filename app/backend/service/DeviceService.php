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
use app\common\model\Device;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;
 

/**
 * 设备服务类
 */
class DeviceService extends Service
{
    /**
     * 设备列表
     *
     * @param array $get
     * @return array
     * @throws DbException
     * @author wait  
     */
    public static function lists(array $get): array
    {
        self::setSearch([
            '=' => ['type','category','is_show'],
			'%like%' => ['sn'],
        ]);
 
        $model = new Device();
        $lists = $model
            ->withoutField(['create_time','update_time','delete_time'])
            ->where(self::$searchWhere)->append(['type_text','category_text'])
            ->order('id desc')
            ->paginate([
                'page'      => $get['page']  ?? 1,
                'list_rows' => $get['limit'] ?? 20,
                'var_page'  => 'page'
            ])->toArray();
 
        return ['count'=>$lists['total'], 'list'=>$lists['data']] ?? [];
    }
 
    /**
     * 设备详情
     *
     * @param int $id
     * @return array
     * @throws DataNotFoundException
     * @throws ModelNotFoundException
     * @author wait 
     */
    public static function detail(int $id): array
    {
        $model = new Device();
        return $model
            ->withoutField('is_delete,delete_time')
            ->where(['id'=>$id])
            ->findOrFail()
            ->toArray();
    }
 
    /**
     * 设备新增
     *
     * @param array $post
     * @author wait  
     */
    public static function add(array $post): void
    {
        Device::create([
            'type' => $post['type'],
            'category' => $post['category'],
            'sn' => $post['sn'],
            'is_show' => $post['is_show'],
            'remark' => $post['remark']??'',
        ]);
    }
 
    /**
     * 设备编辑
     *
     * @param array $post
     * @author wait  
     */
    public static function edit(array $post): void
    {
        Device::update([
            'type' => $post['type'],
            'category' => $post['category'],
            'sn' => $post['sn'],
            'is_show' => $post['is_show'],
            'remark' => $post['remark']??'',
        ], ['id'=>intval($post['id'])]);
    }
 

    /**
     * 设备删除
     *
     * @param int $id
     * @author wait  
     */
    public static function del(int $id): void
    {
        Device::destroy($id);
    }
}