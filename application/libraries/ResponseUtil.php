<?php

/**
 * 输出类
 */
class ResponseUtil
{

    public static function json($data)
    {
        self::output(self::encode($data));
    }

    public static function output($data, $outputType = 'json')
    {
        //在页面执行没有问题的情况下，避免在开发环境下，将调试信息输出。
        $_SERVER['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';

        ob_start();
        switch ($outputType) {
            case 'json':
                header('Content-Type:text/html');
                break;
            case 'xml':
                header('Content-Type:application/xml');
                break;
            default :
                header('Content-Type:text/html');
        }
        echo $data;
        ob_end_flush();
        exit;
    }

    public static function jsonp($data)
    {
        $data = self::encode($data);
        $callback = self::fetchCallBack();
        $output = "{$callback}({$data})";

        self::output($output);
    }

    public static function encode($data)
    {
        if (!is_resource($data)) {
            $encode_data = json_encode($data);
            if (json_last_error() == JSON_ERROR_NONE)
                return $encode_data;

            return '[]';
        }
    }

    public static function fetchCallBack()
    {
        $callbak = Yii::app()->request->getParam('callback');
        if (preg_match('#^\w+$#', $callbak))
            return $callbak;

        return 'callback';
    }

    public static $ResponseStructure = array('detail' => '', 'status' => '',
        'data' => array('content' => array(), 'totalSize' => 0));

    public static function failure($detail = '操作失败')
    {
        self::setData();
        self::setDetail($detail);
        self::$ResponseStructure['status'] = '0';
        self::json(self::$ResponseStructure);
    }

    public static function executeSuccess($detail, $data = '')
    {
        self::setData($data);
        self::setDetail($detail);

        self::$ResponseStructure['status'] = '1';
        self::json(self::$ResponseStructure);
    }

    public static function QuerySuccess($content = array(), $totalSize = 0, $detail = '操作成功')
    {
        if ($detail)
            self::setDetail($detail);

        if (!empty($content))
            self::setContent($content);

        if ($totalSize)
            self::setTotalSize($totalSize);

        self::$ResponseStructure['status'] = '1';
        self::json(self::$ResponseStructure);
    }

    public static function setContent(array $content = array())
    {
        self::$ResponseStructure['data']['content'] = $content;
    }

    public static function setData($data = '')
    {
        self::$ResponseStructure['data'] = $data;
    }

    public static function setTotalSize($totalSize = 0)
    {
        self::$ResponseStructure['data']['totalSize'] = $totalSize;
    }

    public static function setDetail($detail = '')
    {
        self::$ResponseStructure['detail'] = $detail;
    }

    public static function redirect($url)
    {
        ob_start();
        header('location:'. $url);
        ob_end_flush();
        exit;
    }

}
