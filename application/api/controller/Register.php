<?php
namespace app\api\controller;

use app\api\controller\Common;
use app\common\lib\Alisms;
use think\controller;
use app\common\lib\exception\ApiException;

class Register extends Common
{
    /**
     * 设置短信验证码
     */
    public function save(){
        if(!request()->isPost()){
            return show(config('code.error'),'您提交的数据不合法',[],403);
        }

        // 检验数据
        $validate = validate('Identify');
        if(!$validate->check(input('post.'))) {
            return show(config('code.error'), $validate->getError(), [], 403);
        }

        $id = input('param.phone');

        if(Alisms::getInstance()->setSmsIdentify($id)) {
            return show(config('code.success'), 'OK', [], 201);
        }else {
            return show(config('code.error'), "error", [], 403);
        }
    }
}
