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

    Router::addGroup('/auth',function (){
        Router::post('/login',[Admin\Auth\AuthController::class,'login']);
        Router::post('/me',[Admin\Auth\AuthController::class,'me'],['middleware' => [AdminAuthMiddleware::class]]);
    });



});
