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
        if (!is_string($data))
            $data = json_encode($data);

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
        header('location:' . $url);
        ob_end_flush();
        exit;
    }

    public static function createImageVerifyCode($num = 4, $size = 20, $width = 70, $height = 30)
    {

        !$width && $width = $num * $size * 4 / 5 + 5;
        !$height && $height = $size + 10;
        // 去掉了 0 1 O l 等
        $str = "23456789abcdefghijkmnpqrstuvwxyz";
        $code = '';
        for ($i = 0; $i < $num; $i++) {
            $code .= $str[mt_rand(0, strlen($str) - 1)];
        }
        // 画图像
        $im = imagecreatetruecolor($width, $height);
        // 定义要用到的颜色
        $back_color = imagecolorallocate($im, 235, 236, 237);
        $boer_color = imagecolorallocate($im, 118, 151, 199);
        $text_color = imagecolorallocate($im, mt_rand(0, 200), mt_rand(0, 120), mt_rand(0, 120));
        // 画背景
        imagefilledrectangle($im, 0, 0, $width, $height, $back_color);
        // 画边框
        imagerectangle($im, 0, 0, $width - 1, $height - 1, $boer_color);
        // 画干扰线
        for ($i = 0; $i < 5; $i++) {
            $font_color = imagecolorallocate($im, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
            imagearc($im, mt_rand(-$width, $width), mt_rand(-$height, $height), mt_rand(30, $width * 2), mt_rand(20, $height * 2), mt_rand(0, 360), mt_rand(0, 360), $font_color);
        }
        // 画干扰点
        for ($i = 0; $i < 50; $i++) {
            $font_color = imagecolorallocate($im, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
            imagesetpixel($im, mt_rand(0, $width), mt_rand(0, $height), $font_color);
        }
        // 画验证码
        @imagefttext($im, $size, 0, 5, $size + 3, $text_color, APPPATH . 'tunga.ttf', $code);

        UserUtil::setVerifyCode($code);

        header("Cache-Control: max-age=1, s-maxage=1, no-cache, must-revalidate");
        header("Content-type: image/png;charset=gb2312");
        imagepng($im);
        imagedestroy($im);
    }

}
