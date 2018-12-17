<?php
/**
 * Created by PhpStorm.
 * User: baidu
 * Date: 17/7/28
 * Time: 上午12:27
 */
namespace app\common\lib;

use Aliyun\Core\Config;
use Aliyun\Core\Profile\DefaultProfile;
use Aliyun\Core\DefaultAcsClient;
use Aliyun\Api\Sms\Request\V20170525\SendSmsRequest;
use think\Cache;
use think\Log;

require_once EXTEND_PATH.'alisms/vendor/autoload.php';
Config::load();

class Alisms {
    private static $_instance = null;

    private function __construct()
    {
    }

    public static function getInstance(){
        if(is_null(self::$_instance)){
            self::$_instance=new self();
        }
        return self::$_instance;
    }

    //设置短信验证
    public function setSmsIdentify($mobile){
        Log::write('set---sms-start');
        $code = array("code"=>rand(1000, 9999));


        try {
            //获取成员属性
            $accessKeyId = 'LTAIKa8YrY7FXm83'; //阿里云短信获取的accessKeyId
            $accessKeySecret = 'VmlB4dBktjhDUUESqCE9jDdqZQNPq1'; //阿里云短信获取的accessKeySecret
            $signName = '深潜体育';    //短信签名，要审核通过
            $templateCode = 'SMS_152282397';    //短信模板ID，记得要审核通过的
            //短信API产品名（短信产品名固定，无需修改）
            $product = "Dysmsapi";
            //短信API产品域名（接口地址固定，无需修改）
            $domain = "dysmsapi.aliyuncs.com";
            //暂时不支持多Region（目前仅支持cn-hangzhou请勿修改）
            $region = "cn-hangzhou";

            // 初始化用户Profile实例
            $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);
            // 增加服务结点
            DefaultProfile::addEndpoint("cn-hangzhou", "cn-hangzhou", $product, $domain);
            // 初始化AcsClient用于发起请求
            $acsClient= new DefaultAcsClient($profile);

            // 初始化SendSmsRequest实例用于设置发送短信的参数
            $request = new SendSmsRequest();
            // 必填，设置雉短信接收号码
            $request->setPhoneNumbers($mobile);

            // 必填，设置签名名称
            $request->setSignName($signName);

            // 必填，设置模板CODE
            $request->setTemplateCode($templateCode);

            // 可选，设置模板参数
            if($code) {
                $request->setTemplateParam(json_encode($code));
            }

            //发起访问请求
            $acsResponse = $acsClient->getAcsResponse($request);
        }catch (\Exception $e) {
            //设置验证码失效时间
            Log::write("set-----".$e->getMessage());
            return false;
        }

        if($acsResponse->Message === "OK"){
            Cache::set($mobile, $code, config('aliyun.identify_time'));
            return true;
        }else{
            Log::write('set----111'.json_encode($acsResponse));
        }

        return false;
    }

    /**
     * 根据手机号码查询验证码是否正常
     */
    public function checkSmsIdentify($mobile = 0) {
        if(!$mobile){
            return false;
        }
        return Cache::get($mobile);
    }
}