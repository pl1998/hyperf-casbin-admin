<?php

declare(strict_types=1);

namespace App\Controller\Admin\Auth;

use App\Controller\AbstractController;
use App\Model\AdminRole;
use App\Request\RoleRequest;
use Hyperf\Utils\Arr;
use Hyperf\Di\Annotation\Inject;
use App\Services\RoleService;

class RoleController extends AbstractController
{


    /**
     * @Inject
     * @var RoleService
     */
    protected $ruleService;

    /**
     * 获取角色列表
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function index()
    {
        $list = AdminRole::where('status',AdminRole::STATUS_OK)->get();
        return $this->success($list);
    }

    /**
     * 添加角色
     * @param RoleRequest $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function store(RoleRequest $request)
    {
        $params = $request->all();

        $roleId = AdminRole::insertGetId(Arr::only($params,['name','description','status']));

        if($roleId) {
            $this->ruleService->addPermissionForUser($roleId,$params['node']);
        }

        return $this->fail('创建角色失败');

    }

    /**
     * 更新角色信息
     * @param $id
     * @param RoleRequest $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function update($id,RoleRequest $request)
    {
        $params = $request->all();

        $roleId = AdminRole::where('id',$id)->update(Arr::only($params,['name','description','status']));

        if($roleId) {
            $this->ruleService->deletePermissionsForUser($roleId);
            $this->ruleService->addPermissionForUser($roleId,$params['node']);
        }

        return $this->fail('创建角色失败');
    }

    public function delete($id)
    {
        AdminRole::where('id',$id)->delete();
        $this->ruleService->deletePermissionsForUser($id);
        return $this->success('删除角色成功');
    }
}
