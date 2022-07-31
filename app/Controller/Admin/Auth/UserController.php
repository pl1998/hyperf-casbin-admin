<?php

declare(strict_types=1);

namespace App\Controller\Admin\Auth;

use App\Controller\AbstractController;
use App\Model\AdminUser;
use App\Request\AuthRequest;
use App\Request\UserRequest;
use App\Services\UserService;
use Hyperf\Di\Annotation\Inject;

class UserController extends AbstractController
{
    /**
     * @Inject
     * @var UserService
     */
    protected $userService;

    /**
     * 获取用户列表
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function index()
    {
        $page     = $this->request->input('page',1);
        $pageSize = $this->request->input('pageSize',10);
        $name     = $this->request->input('name');
        $email    = $this->request->input('email');
        $status   = $this->request->input('status');

        $query = AdminUser::query()
            ->when(!empty($name),function ($query) use($name){
            return $query->where('name','like',"$name%");
            })
            ->when(!empty($name),function ($query) use($name){
                return $query->where('name','like',"$name%");
            })
            ->when(!empty($email),function ($query) use($email){
                return $query->where('email','like',"$email%");
            })
            ->when(!empty($status),function ($query) use($status){
                return $query->where('status',$status);
            });
        $total = $query->count();

        $list = $query->forPage($page,$pageSize)->get();

        return $this->success([
            'list'=>$list,
            'mate'=>[
                'page' => (int)$page,
                'pageSize' => (int)$pageSize,
                'total' => $total,
            ]
        ]);
    }

    public function store(UserRequest $request)
    {
        $user = new AdminUser();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $user->getPassword($request->input('password'));
        $result = $user->save();

        if($result){
            $this->userService->addRoleForUser($user->id,$request->input('roles'));

            return $this->success();
        }
        return $this->fail('用户创建失败');
    }

    /**
     * 更新用户信息
     * @param $id
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function update($id)
    {
        $request = $this->container->get(UserRequest::class);
        $request->scene('update')->validateResolved();

        $user = AdminUser::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if(!empty($password = $request->input('password'))){
            $user->password = $user->getPassword($password);
        }
        $result = $user->save();

        if($result){
            $this->userService->deleteRolesForUser($id);
            $this->userService->addRoleForUser($id,$request->input('roles'));

            return $this->success();
        }
        return $this->fail('用户更新失败');
    }

    /**
     * 删除用户
     * @param $id
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function delete($id)
    {
        AdminUser::where('id',$id)->delete();
        return $this->success();
    }



}
