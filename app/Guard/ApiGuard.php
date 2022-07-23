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
    /**
     * @var string
     */
    protected $defaultDriver = 'api';
}
