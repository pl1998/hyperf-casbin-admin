<?php
declare(strict_types=1);
/**
 * Created By PhpStorm.
 * User : Latent
 * Date : 2022/7/23
 * Time : 00:05
 **/

namespace App\Traits;

use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\Utils\Codec\Json;
use Hyperf\Utils\Contracts\Arrayable;
use Hyperf\Utils\Contracts\Jsonable;
use Psr\Http\Message\ResponseInterface;
use Hyperf\Di\Annotation\Inject;

trait ApiResponse
{
    /**
     * @Inject
     * @var ResponseInterface
     */
    protected $response;


    /**
     * @param $response
     * @return ResponseInterface
     */
    private function respond($response): ResponseInterface
    {
        if (is_string($response)) {
            return $this->response->withAddedHeader('content-type', 'text/plain')->withBody(new SwooleStream($response));
        }

        if (is_array($response) || $response instanceof Arrayable) {
            return $this->response
                ->withAddedHeader('content-type', 'application/json')
                ->withBody(new SwooleStream(Json::encode($response)));
        }

        if ($response instanceof Jsonable) {
            return $this->response
                ->withAddedHeader('content-type', 'application/json')
                ->withBody(new SwooleStream((string)$response));
        }

        return $this->response->withAddedHeader('content-type', 'text/plain')->withBody(new SwooleStream((string)$response));
    }

    /**
     * 成功响应
     * @param $data
     * @param $message
     * @param $code
     * @return ResponseInterface
     */
    public function success( $data=[], $message='Success', $code=200){
        return $this->respond([
            'code'=>$code,
            'message'=>$message,
            'data'=>$data ?? (object)[],
            'time'=>time()
        ]);
    }

    /**
     * 异常返回
     * @param $message
     * @param $code
     * @param $data
     * @return ResponseInterface
     */
    public function fail( $message='Error', $code=500,$data=[]){
        return $this->respond([
            'code'=>$code,
            'message'=>$message,
            'data'=>(object)$data,
            'time'=>time()
        ]);
    }

}
