<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 15-12-14
 * Time: 下午11:30
 */
class UrlUtil
{
    public static function createUrl($urlPath)
    {
        get_instance()->load->helper('url');

        return base_url() . $urlPath;
    }

    public static function createBackendUrl($urlPath)
    {
        return self::createUrl('backend/' . $urlPath);
    }
}