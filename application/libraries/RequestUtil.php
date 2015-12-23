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
        get_instance()->load->helper('common');
        return array_filter(array_map('xss_clean', $_GET), 'clearEmpty');
    }

    public static function postParams()
    {
        get_instance()->load->helper('common');
        return array_filter(array_map('xss_clean', $_POST), 'clearEmpty');
    }

    public static function isAjax()
    {
        return (isset($_SERVER["HTTP_X_REQUESTED_WITH"])
            && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) === "xmlhttprequest");
    }

    public static function isPost()
    {
        return strtolower($_SERVER['REQUEST_METHOD']) === 'post';
    }

    public static function isGet()
    {
        return strtolower($_SERVER['REQUEST_METHOD']) === 'get';
    }

    /**
     * 获得当前请求的控制器与方法
     * @return string
     */
    public static function CM($params = array())
    {
        $instance = get_instance();
        $segments = $instance->uri->segments;
        $controller = array_shift($segments);
        $baseUrl = $controller . '/' . array_shift($segments);

        // 在controllers里判断 是不是目录
        if (is_dir(APPPATH . 'controllers' . DS . $controller)) {
            $baseUrl .= '/' . array_shift($segments);
        }

        return $instance->config->base_url() . $baseUrl . '/' . implode('/', $params);
    }

    public static function likeParams()
    {
        $params = self::getParams();
        if ($params) {
            array_walk($params, function (&$item, $key) {
                $item = "{$key} like '%{$item}%'";
            });
        }

        return $params;
    }

    public static function likeParamsWithDisabled()
    {
        $params = self::likeParams();
        $params['disabled'] = 'disabled=0';

        return implode('and ', $params);
    }
}