<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/29
 * Time: 13:22
 */
class LogUtil
{
    public static $weinxi = 'weixin-log';

    public static function log($message, $file = 'log')
    {
        $saveFile = APPPATH . DIRECTORY_SEPARATOR . 'cache';
        $saveFile = $saveFile . DIRECTORY_SEPARATOR . $file . date('Y-m-d');

        if (!is_string($message))
            $message = json_encode($message);

        file_put_contents($saveFile, $message . "\n\n" . str_repeat('-', 80) ."\n", FILE_APPEND);
    }

    public static function weixinLog($message)
    {
        self::log($message, self::$weinxi);
    }

}