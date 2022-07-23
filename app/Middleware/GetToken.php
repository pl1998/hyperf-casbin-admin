<?php
/**
 * Created By PhpStorm.
 * User : Latent
 * Date : 2022/7/23
 * Time : 12:30
 **/

namespace App\Middleware;

use Hyperf\Utils\Str;

trait GetToken
{
    public function getToken()
    {
        $header = $this->request->header('authorization',$this->request->input('token'));

        if (Str::startsWith($header, 'Bearer ')) {
            return  Str::substr($header, 7);
        }

        if ($this->request->has('token')) {
            return $this->request->input('token');
        }
        return null;
    }
}
