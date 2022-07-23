<?php
/**
 * Created By PhpStorm.
 * User : Latent
 * Date : 2022/7/23
 * Time : 10:32
 **/

namespace App\Exception\Handler;

use App\Constants\ErrorCode;
use Hyperf\Validation\ValidationExceptionHandler as ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Psr\Http\Message\ResponseInterface;
use Throwable;


class ValidationExceptionHandler extends ExceptionHandler
{
    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        $this->stopPropagation();
        /** @var \Hyperf\Validation\ValidationException $throwable */
        $body = $throwable->validator->errors()->first();
        if (! $response->hasHeader('content-type')) {
            $response = $response->withAddedHeader('content-type', 'text/plain; charset=utf-8');
        }
        return $response->withHeader('Server', 'Hyperf')->withStatus(200)->withBody(new SwooleStream(json_encode([
            'code' => ErrorCode::PARAM_ERROR ,
            'message' => $body
        ],JSON_UNESCAPED_UNICODE)));
    }
}
