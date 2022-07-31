<?php
declare (strict_types=1);
/**
 * Created By PhpStorm.
 * User : Latent
 * Date : 2022/7/31
 * Time : 11:30
 **/

namespace App\Services;

use Donjan\Casbin\Enforcer;
use App\Model\AdminRole;

class UserService
{
    use Casbin;


    /**
     * 为用户添加角色
     * @param $id
     * @param array $roles
     * @return void
     */
    public function addRoleForUser($id,array $roles)
    {
        $userIdStr = $this->getUserKey($id);
        AdminRole::where('status',AdminRole::STATUS_OK)
            ->whereIn('id',$roles)
            ->get()
            ->map(function ($value)use($userIdStr){
                Enforcer::addRoleForUser($userIdStr, $value->id);
            });
    }

    /**
     * 删除用户所有角色
     * @param $id
     * @return void
     */
    public function deleteRolesForUser($id)
    {
        $userIdStr = $this->getUserKey($id);
        Enforcer::deleteRolesForUser($userIdStr );
    }
}
