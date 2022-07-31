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
use Hyperf\Di\Annotation\Inject;

class PermissionService
{
    use Casbin;
    /**
     * @Inject
     * @var RoleService
     */
    protected $ruleService;

    public function getUserPermissionList($id)
    {
        // 获取用户所有角色
        $nodes = Enforcer::getPermissionsForUser($this->getUserKey($id));

    }
}
