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
    public static function loadConfig($config)
    {
        $congigPath = APPPATH . 'config' . DS . $config . '.php';
        if (!file_exists($congigPath))
            show_404($congigPath . '不存在!');

        return include $congigPath;
    }
} 