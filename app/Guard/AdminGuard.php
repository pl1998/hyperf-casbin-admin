<?php
/**
 * Created By PhpStorm.
 * User : Latent
 * Date : 2022/7/23
 * Time : 11:19
 **/

namespace App\Guard;

use Qbhy\HyperfAuth\AuthManager;

class AdminGuard extends AuthManager
{
    protected $auth = 'admin';

    public function defaultGuard(): string
    {
        return $this->config[$this->auth]['guard'] ?? $this->defaultDriver;
    }

}
