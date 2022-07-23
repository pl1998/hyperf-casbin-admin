<?php

declare(strict_types=1);

namespace App\Command;

use App\Model\AdminUser;
use Hyperf\Command\Command as HyperfCommand;
use Hyperf\Command\Annotation\Command;
use HyperfExt\Hashing\Hash;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
/**
 * @Command
 */
#[Command]
class AdminInstall extends HyperfCommand
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

        parent::__construct('admin:install');
    }

    public function configure()
    {
        parent::configure();
        $this->setDescription('Hyperf Demo Command');
    }




    public function handle()
    {
        // 数据库迁移
        $this->call('migrate');

        // 生成jws相关信息
        $this->call('gen:auth-env');

        // 创建一个登录用户
        $this->call('auth:account');
    }
}
