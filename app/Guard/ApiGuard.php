<?php
/**
 * Created By PhpStorm.
 * User : Latent
 * Date : 2022/7/23
 * Time : 11:20
 **/

namespace App\Guard;

use Qbhy\HyperfAuth\AuthManager;

class ApiGuard extends AuthManager
{
    protected $auth = 'api';

    public function defaultGuard(): string
    {
        return $this->config[$this->auth]['guard'] ?? $this->defaultDriver;
    }
}
