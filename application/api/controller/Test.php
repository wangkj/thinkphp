<?php
namespace app\api\controller;

use app\common\lib\Alisms;
use think\Controller;
use app\common\lib\exception\ApiException;

use alisms\SendSms;

class Test extends Common
{
    public function index(){
        return [
          'asvb',
          'adsda',
        ];
    }

    public function update($id = 0){

//        $id = input('put.id');
        halt(input('put.'));
//        return $id;
    }

    public function save(){
        $data = input('post.');
        if($data['mt'] != 1){
            throw new ApiException('您提交的数据不合法',400);
//            exception('您提交的数据不合法');
        }
        return show(1,'OK',input('post.'),201);
    }

    static $acsClient = null;

    public function sms()
    {
        $sms = new SendSms();
        //设置关键的四个配置参数，其实配置参数应该写在公共或者模块下的config配置文件中，然后在获取使用，这里我就直接使用了。
//        $sms->accessKeyId = '××××××××';
//        $sms->accessKeySecret = '×××××××××';
//        $sms->signName = '浪博电子';
//        $sms->templateCode = 'SMS_×××××××';

        //$mobile为手机号
        $mobile = '18903508019';
        //模板参数，自定义了随机数，你可以在这里保存在缓存或者cookie等设置有效期以便逻辑发送后用户使用后的逻辑处理
        $code = mt_rand();
        $templateParam = array("code"=>$code);
        $m = $sms->send($mobile,$templateParam);
        //类中有说明，默认返回的数组格式，如果需要json，在自行修改类，或者在这里将$m转换后在输出
        dump($m);

    }

    public function testsend(){
        Alisms::getInstance()->setSmsIdentify('18903508019');
    }


}
