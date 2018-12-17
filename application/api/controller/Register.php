<?php
namespace app\api\controller;

use app\api\controller\Common;
use think\controller;
use app\common\lib\exception\ApiException;

class Register extends Common
{
    /**
     * 设置短信验证码
     */
    public function save(){
        if(!request()->isPost()){
            return show(config('code.error'),'您提交的数据不合法,[],403');
        }

        //校验数据
        
    }
}
