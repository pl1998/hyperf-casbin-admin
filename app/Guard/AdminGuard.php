<?php
/**
 * Created By PhpStorm.
 * User : Latent
 * Date : 2022/7/23
 * Time : 11:19
 **/

namespace App\Guard;

use Qbhy\HyperfAuth\AuthGuard;
use Qbhy\HyperfAuth\AuthManager;
use Qbhy\HyperfAuth\Exception\GuardException;
use Qbhy\HyperfAuth\Exception\UserProviderException;
use Qbhy\HyperfAuth\UserProvider;

class AdminGuard extends AuthManager
{
    protected $auth = 'admin';

    public function defaultGuard(): string
    {
        return $this->config[$this->auth]['guard'] ?? $this->defaultDriver;
    }

}
