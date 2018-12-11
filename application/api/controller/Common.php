<?php
namespace app\api\controller;

use app\common\lib\IAuth;
use think\Controller;
use app\common\lib\exception\ApiException;
use app\common\lib\Aes;

//api模块公共控制器
class Common extends Controller
{
    public $headers = '';
    //初始化方法
    public function _initialize()
    {
            $this->checkRequestAuth();
//        $this->testAes();
//        parent::_initialize(); // TODO: Change the autogenerated stub
    }

    //校验方法，检查每次app请求的数据是否合法
    public function checkRequestAuth(){
        //1.获取header头的数据
        $headers = request()->header();
//        halt($headers);
        //2.加密
        //3.基础参数校验
        if(empty($headers['sign'])){
            throw new ApiException('sign不存在',400);
        };
        if(!in_array($headers['app_type'],config('app.apptypes'))){
            throw new ApiException('app_type类型不合法',400);
        };

        //4.校验sign合法性
        if(!IAuth::checkSignPass($headers)){
            throw new ApiException('授权码sign失败',401);
        };
        $this->headers = $headers;
    }

    //测试
    public function testAes(){
//        $str = "id=1&ms=45&username=singwa";
//        $aes_str = 'pN8EZu+Ey7DbmcpFqKvIIhbb0F+UcDJye8DiGHng6XQ=';
//        echo (new Aes())->decrypt($aes_str);exit;
        $data = [
          'did' => '123dsa',
          'version' => '1',
        ];
        $str = 'izxvF/vYIIWlFa9f59bnwKGCuB9p3Tb1ZzAg/sjdq90=';
        echo (new Aes()) ->decrypt($str);exit;
//        echo IAuth::setSign($data);exit;
    }
}
