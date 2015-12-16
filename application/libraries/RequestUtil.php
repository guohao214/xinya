<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-12-16
 * Time: 下午4:22
 */
class RequestUtil
{
    public static function getParams()
    {
        return array_filter($_GET, 'xss_clean');
    }

    public static function postParams()
    {
        return array_filter($_POST, 'xss_clean');
    }

} 