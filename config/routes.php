<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use Hyperf\HttpServer\Router\Router;
use App\Middleware\AdminAuthMiddleware;
use App\Controller\Admin as Admin;

Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController@index');

Router::get('/favicon.ico', function () {
    return '';
});

// 后台
Router::addGroup('/admin',function (){

    Router::post('/login',[Admin\Auth\AuthController::class,'login']);
    Router::post('/me',[Admin\Auth\AuthController::class,'me'],['middleware' => [AdminAuthMiddleware::class]]);

    Router::addGroup('/auth',function (){

        // 用户
        Router::get('/users',[Admin\Auth\UserController::class,'index']); // 获取用户列表
        Router::POST('/users',[Admin\Auth\UserController::class,'store']); // 新增用户
        Router::put('/users/{id}',[Admin\Auth\UserController::class,'update']); // 更新用户信息
        Router::delete('/users/{id}',[Admin\Auth\UserController::class,'delete']); // 删除用户

        // 角色
        Router::get('/roles',[Admin\Auth\RoleController::class,'index']); // 获取角色列表
        Router::POST('/roles',[Admin\Auth\RoleController::class,'store']); // 新增角色
        Router::put('/roles/{id}',[Admin\Auth\RoleController::class,'update']); // 更新角色
        Router::delete('/roles/{id}',[Admin\Auth\RoleController::class,'delete']); // 删除角色

        // 权限
        Router::get('/permissions',[Admin\Auth\PermissionController::class,'index']); // 获取所有的权限菜单列表
        Router::POST('/permissions',[Admin\Auth\PermissionController::class,'store']); // 新增权限以及菜单
        Router::put('/permissions/{id}',[Admin\Auth\PermissionController::class,'update']); // 更新权限以及菜单
        Router::delete('/permissions/{id}',[Admin\Auth\PermissionController::class,'delete']); // 删除权限以及菜单

        Router::get('/getUserPermissions',[Admin\Auth\PermissionController::class,'getUserPermissions']); // 获取所有的权限菜单列表



    },['middleware' => [AdminAuthMiddleware::class]]);


});
