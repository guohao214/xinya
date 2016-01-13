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

    /**
     * 检测是否为有效的url链接， 只能是.xinyameirong.com域名下
     * @param $url
     * @return bool
     */
    public static function isValidUrl($url)
    {
        return true;
        $pattern = '~^http[s]?://\w+\.xinyameirong\.com~';
        return preg_match($pattern, $url);
    }
}