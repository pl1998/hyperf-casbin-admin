<?php
/**
 * Created By PhpStorm.
 * User : Latent
 * Date : 2022/7/23
 * Time : 11:58
 **/

namespace App\Exception\Handler;
use App\Constants\ErrorCode;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Psr\Http\Message\ResponseInterface;
use Qbhy\HyperfAuth\AuthExceptionHandler as ExceptionHandler;
use Throwable;
class AuthExceptionHandler extends ExceptionHandler
{
    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        $this->stopPropagation();
        return $response->withHeader('Server', 'Hyperf')->withStatus($throwable->getStatusCode())->withBody(new SwooleStream(json_encode([
            'code' => ErrorCode::SERVER_ERROR ,
            'message' => $throwable->getMessage()
        ],JSON_UNESCAPED_UNICODE)));
    }
}
