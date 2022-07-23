<?php

declare(strict_types=1);

namespace App\Middleware;

use Hyperf\Utils\Str;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Hyperf\HttpServer\Contract\RequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Hyperf\HttpServer\Contract\ResponseInterface as HttpResponse;
use App\Guard\AdminGuard;

class AdminAuthMiddleware implements MiddlewareInterface
{

    use GetToken;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var HttpResponse
     */
    protected $response;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var AdminGuard
     */
    protected $auth;

    public function __construct(ContainerInterface $container,AdminGuard $adminGuard,HttpResponse $response,RequestInterface $request)
    {
        $this->container = $container;
        $this->auth = $adminGuard;
        $this->response = $response;
        $this->request = $request;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $token = $this->getToken();

        if(!$token) {
            return $this->response->withStatus(401)->json([
                'code'=>401,
                'message'=>'token不存在',
                'data'=>(object)[]
            ]);
        }

        if(!$this->auth->check($token)) {
            return $this->response->withStatus(401)->json([
                'code'=>401,
                'message'=>'token校验失败',
                'data'=>(object)[]
            ]);
        }
        return $handler->handle($request);
    }
}
