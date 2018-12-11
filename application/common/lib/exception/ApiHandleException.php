<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/11 0011
 * Time: 23:06
 */

namespace app\common\lib\exception;

use Exception;
use think\exception\Handle;

class ApiHandleException extends Handle{
    public $httpCode = 500;

    public function render(\Exception $e)
    {
        if(config('app_debug') == true){
            return parent::render($e);
        }
        if ($e instanceof ApiException){
            $this->httpCode = $e->httpCode;
        }
        return show(0,$e->getMessage(),[],$this->httpCode);
    }
}