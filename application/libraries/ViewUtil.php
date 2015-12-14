<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 15-12-14
 * Time: 下午11:08
 */
class ViewUtil
{
    private static $backendStaticPath = '';

    public static function setBackendStaticPath($path)
    {
        self::$backendStaticPath = $path;
    }

    public static function getBackendStaticPath()
    {
        return self::$backendStaticPath;
    }
} 