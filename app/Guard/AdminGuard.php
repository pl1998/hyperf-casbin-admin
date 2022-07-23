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
    /**
     * @var string
     */
    protected $defaultDriver = 'admin';
}
