<?php
declare (strict_types=1);
/**
 * Created By PhpStorm.
 * User : Latent
 * Date : 2022/7/31
 * Time : 11:30
 **/

namespace App\Services;

use App\Model\AdminPermission;
use Donjan\Casbin\Enforcer;

class RoleService
{
    use Casbin;


    /**
     * 为角色添加权限
     * @param int $roleId
     * @param array $node
     * @return void
     */
    public function addPermissionForUser(int $roleId, array $node)
    {
        $roleIdStr = $this->getRoleKey($roleId);

        AdminPermission::where('status', AdminPermission::STATUS_OK)
            ->where('hidden', AdminPermission::HIDDEN_OK)
            ->where('id', $node)
            ->get()->map(function ($value) use ($roleIdStr) {
                if ($value->is_menu == AdminPermission::IS_MENU_YES) {
                    Enforcer::addPermissionForUser($roleIdStr, $value->route, $value->method);
                } else {
                    Enforcer::addPermissionForUser($roleIdStr, $value->api_route, $value->method);
                }
            });
    }

    /**
     * 删除用户或者角色的所有权限
     * @param int $roleId
     * @return void
     */
    public function deletePermissionsForUser(int $roleId)
    {
        $roleIdStr = $this->getRoleKey($roleId);
        Enforcer::deletePermissionsForUser($roleIdStr);
    }
}
