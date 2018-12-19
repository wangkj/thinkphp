<?php
namespace app\api\controller;

use app\api\controller\Common;
use app\common\lib\Alisms;
use app\common\lib\IAuth;
use app\common\model\User;
use think\controller;
use app\common\lib\exception\ApiException;

class Login extends Common
{
    /**
     * post
     * 注册
     */
    public function save(){
        if(!request()->isPost()){
            return show(config('code.error'),'没有权限','',404);
        }

        $param = input('param.');
        if(empty($param['phone'])){
            return show(config('code.error'),'手机不合法','',404);
        }
        if(empty($param['code'])){
            return show(config('code.error'),'验证码不合法','',404);
        }

        $code = Alisms::getInstance()->checkSmsIdentify($param['phone']);
        if($code['code'] != $param['code']){
            return show(config('code.error'),'验证码错误',[$code['code'],$param['code']],404);
        }


        $token = IAuth::setAppLoginToken($param['phone']);
        $data = [
            'token' => $token,
            'time_out' => strtotime("+90 days"),
        ];
        //查询手机号是否存在
        $user = User::get(['phone'=>$param['phone']]);

        if($user && $user->status == 1) {
            if(!empty($param['password'])) {
                // 判定用户的密码 和 $param['password'] 加密之后
                if(IAuth::setPassword($param['password']) != $user->password) {
                    return show(config('code.error'), '密码不正确', [], 403);
                }
            }
            $id = model('User')->save($data, ['phone' => $param['phone']]);
        } else {
            if(!empty($param['code'])) {
                // 第一次登录 注册数据
                $data['username'] = '深潜用户' . $param['phone'];
                $data['status'] = 1;
                $data['phone'] = $param['phone'];//1caee2c8012cf16f5c2a6e151cd91442714c720b
                //45077d10c31a2ea59eb785020625101e695d3d20

                $id = model('User')->add($data);
            } else {
                return show(config('code.error'), '用户不存在', [], 403);
            }
        }

        if($id) {
            $result = [
              'token' => $token,
            ];
            return show(config('code.success'),'ok',$result,200);
        }else{
            return show(config('code.error'),'ok','登陆失败',403);
        }
    }
}
