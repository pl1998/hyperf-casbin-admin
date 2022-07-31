<?php

declare(strict_types=1);

namespace App\Controller\Admin\Auth;

use App\Controller\AbstractController;
use App\Guard\AdminGuard;
use App\Model\AdminPermission;
use App\Request\PermissionRequest;
use App\Services\PermissionService;
use Hyperf\Di\Annotation\Inject;


class PermissionController extends AbstractController
{


    /**
     * @Inject
     * @var PermissionService
     */
    protected $permissionService;


    /**
     * @Inject
     * @var AdminGuard
     */
    protected $auth;


    /**
     * 获取权限列表
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function index()
    {
        $list = AdminPermission::getList();
        $list = get_tree($list);
        return $this->success($list);
    }


    /**
     * 添加权限以及菜单节点
     * @param PermissionRequest $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function store(PermissionRequest $request)
    {
        AdminPermission::create($request->all());

        return $this->success();
    }

    /**
     * 更新权限以及菜单节点
     * @param $id
     * @param PermissionRequest $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function update($id,PermissionRequest $request)
    {
        AdminPermission::where('id',$id)->update($request->all());

        return $this->success();
    }

    /**
     * 更新权限以及菜单节点
     * @param $id
     * @param PermissionRequest $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function delete($id)
    {
        AdminPermission::where('id',$id)->forceDelete();

        return $this->success();
    }

    // 获取当前用户权限
    public function getUserPermissions()
    {
        $this->permissionService->getUserPermissionList($this->auth->id());
    }
}
