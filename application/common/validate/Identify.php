<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/14 0014
 * Time: 12:40
 */
namespace app\common\validate;

use think\Validate;
class Identify extends Validate{
    protected $rule = [
        'id' => 'require|number|length:11',
    ];
}