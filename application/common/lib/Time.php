<?php
/**
 * Created by PhpStorm.
 * User: baidu
 * Date: 17/7/28
 * Time: 上午12:27
 */
namespace app\common\lib;

class Time {
    public static function get13TimeStamp() {
//        halt(microtime());
        list($t1, $t2) = explode(' ',microtime());

        return $t2.ceil($t1*1000);
    }
}