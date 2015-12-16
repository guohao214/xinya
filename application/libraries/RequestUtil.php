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
        return array_map('xss_clean', $_GET);
    }

    public static function postParams()
    {
        return array_map('xss_clean', $_POST);
    }
}
