<?php
declare(strict_types=1);
/**
 * Created By PhpStorm.
 * User : Latent
 * Date : 2022/7/23
 * Time : 08:47
 **/

namespace App\Controller\Admin\Auth;

use App\Controller\AbstractController;
use App\Model\AdminUser;
use App\Request\AuthRequest;
use HyperfExt\Hashing\Hash;
use Qbhy\HyperfAuth\AuthManager;
use Hyperf\Di\Annotation\Inject;

class AuthController extends AbstractController
{
    /**
     * @Inject
     * @var AuthManager
     */
    protected $auth;


    /**
     * 登录接口
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function login()
    {
        $request = $this->container->get(AuthRequest::class);
        $request->scene('login')->validateResolved();

        $email    = $request->input('email');
        $password = $request->input('password');

        $users = AdminUser::where('email',$email)->first();

        if(!$users) return $this->fail('用户不存在！');

        if(!Hash::check($password,$users->password)){
            $this->fail('密码错误！');
        }

        $token = $this->auth->guard('admin')->login($users);

        return $this->success([
            'user_id'=>$users->id,
            'token'=>$token,
            'refresh_ttl' => config('auth.refresh_ttl')
        ]);

    }

    public function me()
    {
        $user = $this->auth->guard('admin')->user();
        return $this->success([
            'user_id'=>$user->id,
            'avatar'=>$user->avatar,
            'name'=>$user->name,
            'menus'=>[],
            'roles'=>[],
            'nodes'=>[]
        ]);
    }
}
