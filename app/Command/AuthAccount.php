<?php

declare(strict_types=1);

namespace App\Command;

use App\Model\AdminUser;
use Hyperf\Command\Command as HyperfCommand;
use Hyperf\Command\Annotation\Command;
use HyperfExt\Hashing\Hash;
use Psr\Container\ContainerInterface;

/**
 * @Command
 */
#[Command]
class AuthAccount extends HyperfCommand
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

        parent::__construct('auth:account');
    }

    public function configure()
    {
        parent::configure();
        $this->setDescription('Hyperf Demo Command');
    }

    public function handle()
    {
        $email='admin@hyperf.com';
        $password ='hyperfyyds';
        $users = AdminUser::where('email',$email)->first();
        if($users){
            $users->password = Hash::make($password);
            $users->save();
            $this->info('密码更新成功!');
            $this->info('密码: '.$password);
        } else {
            $result = AdminUser::create([
                'name'=>'admin',
                'email'=>$email,
                'password'=>Hash::make($password),
                'status'=>AdminUser::STATUS_YES
            ]);
            if($result){
                $this->info('账号创建成功!');
                $this->info('账号: '.$email);
                $this->info('密码: '.$password);
            } else{
                $this->error('账号创建失败!');
            }
        }
    }
}
