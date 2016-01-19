<?php

/**
 * 加载自定义配置
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-12-16
 * Time: 下午1:13
 */
class ConfigUtil
{
    public static function getConfigPath($config)
    {
        return APPPATH . 'config' . DS . $config . '.php';
    }

    public static function loadConfig($config)
    {
        $_config = $config;

        $congigPath = self::getConfigPath($config);
        if (!file_exists($congigPath))
            get_instance()->message($_config . '配置文件不存在， 亲重试！');

        return include $congigPath;
    }
} 