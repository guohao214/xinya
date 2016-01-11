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

    public static function buildLikeQueryParams()
    {
        $params = self::getParams();
        if ($params) {
            array_walk($params, function (&$item, $key) {
                if (is_numeric($item))
                    $item = "{$key} = {$item}";
                else
                    $item = "{$key} like '%{$item}%'";
            });
        }

        return $params;
    }

    public static function buildLikeQueryParamsWithDisabled()
    {
        $params = self::buildLikeQueryParams();
        $params['disabled'] = 'disabled=0';

        return implode(' and ', $params);
    }

    public static function post($url, $data)
    {
        $curl = curl_init(); // 启动一个CURL会话
        curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //SSL 报错时使用
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); //SSL 报错时使用

        curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包
        curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
        curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回

        $tmpInfo = curl_exec($curl); // 执行操作
        if (curl_errno($curl)) {
            echo 'Errno' . curl_error($curl); //捕抓异常
        }
        curl_close($curl); // 关闭CURL会话

        $jsonData = json_decode($tmpInfo);
        if (json_last_error() != JSON_ERROR_NONE)
            return '';

        return $jsonData;
    }


    public static function get($url)
    {
        $curl = curl_init(); // 启动一个CURL会话
        curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //SSL 报错时使用
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); //SSL 报错时使用

        //curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
        //curl_setopt($curl, CURLOPT_COOKIE, $cookie);
        //curl_setopt($curl, CURLOPT_REFERER,'https://www.baidu.com');// 设置Referer
        //curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
        //curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包
        curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
        curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回

        $tmpInfo = curl_exec($curl); // 执行操作
        if (curl_errno($curl)) {
            echo 'Errno' . curl_error($curl); //捕抓异常
        }
        curl_close($curl); // 关闭CURL会话

        $jsonData = json_decode($tmpInfo, true);
        if (json_last_error() != JSON_ERROR_NONE)
            return '';

        return $jsonData;
    }
}