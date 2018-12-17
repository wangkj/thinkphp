<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/12 0012
 * Time: 0:12
 */
return [
    'password_pre_halt' => '_#deepdive',// 密码加密盐
    'aeskey' => 'deepdive45747ss223',//aes 密钥
    'apptypes' => [
        'ios',
        'android',
    ],
    'app_sign_time' => 7776000,
    'app_sign_cache_time' => 3, //sign缓存失效时间
];