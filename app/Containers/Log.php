<?php
declare(strict_types=1);
/**
 * Created By PhpStorm.
 * User : Latent
 * Date : 2022/7/22
 * Time : 23:41
 **/

namespace App\Containers;

use Hyperf\Logger\LoggerFactory;
use Hyperf\Utils\ApplicationContext;

class Log
{
    public static function get(string $name = 'app')
    {
        return ApplicationContext::getContainer()->get(LoggerFactory::class)->get($name);
    }
}
