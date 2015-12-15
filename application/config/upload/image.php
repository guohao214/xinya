<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-12-15
 * Time: 下午6:32
 */

$config = array(
    'allowed_types' => 'gif|jpg|png',
    'max_size' => '1000000',
//    'max_width' => '1024',
//    'max_height' => '768',
    'encrypt_name' => true
);

$common = include __DIR__ . DS . 'common.php';

return array_merge($config, $common);