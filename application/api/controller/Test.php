<?php
namespace app\api\controller;

use think\Controller;
use app\common\lib\exception\ApiException;

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
}
