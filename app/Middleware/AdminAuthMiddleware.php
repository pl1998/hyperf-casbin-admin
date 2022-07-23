<?php

declare(strict_types=1);

namespace App\Middleware;

use Hyperf\HttpServer\Contract\RequestInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Hyperf\HttpServer\Contract\ResponseInterface as HttpResponse;
use Hyperf\Di\Annotation\Inject;
use App\Guard\AdminGuard;

class AdminAuthMiddleware implements MiddlewareInterface
{

    /**
     * @Inject
     * @var RequestInterface
     */
    protected $request;

    /**
     * @Inject
     * @var HttpResponse
     */
    protected $response;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @Inject
     * @var AdminGuard
     */
    protected $auth;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $token = $this->request->header('authorization',$this->request->input('token'));

        if(!$token) {
            return $this->response->withStatus(401)->json([
                'code'=>401,
                'message'=>'token不存在',
                'data'=>(object)[]
            ]);
        }
        if(!$this->auth->guard('admin')->check($token)) {
            return $this->response->withStatus(401)->json([
                'code'=>401,
                'message'=>'token校验失败',
                'data'=>(object)[]
            ]);
        }
        return $handler->handle($request);
    }
}
