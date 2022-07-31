<?php
/**
 * Created By PhpStorm.
 * User : Latent
 * Date : 2022/7/31
 * Time : 13:26
 **/

namespace App\Services;

trait Casbin
{
    /**
     * 获取用户key
     * @param int $id
     * @return string
     */
    public function getUserKey(int $id): string
    {
        return 'user_' . $id;
    }

    public function getRoleKey(int $id): string
    {
        return 'role_' . $id;
    }

}
