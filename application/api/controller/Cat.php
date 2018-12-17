<?php
namespace app\api\controller;

use think\Controller;
use app\common\lib\exception\ApiException;

class Cat extends Common
{
    public function read(){
        $cats = config('cat.lists');
//        halt($cats);
        $result = [];
        foreach($cats as $catid => $catname) {
            $result[] = [
                'catid' => $catid,
                'catname' => $catname,
            ];
        }
        return show(config('code.success'),"ok",$result,200);
    }
}
