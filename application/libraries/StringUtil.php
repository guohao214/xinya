<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 2015/12/24
 * Time: 23:29
 */
class StringUtil
{

    public static function substr($string, $length = 10)
    {
        return mb_substr($string, 0, $length);
    }

    /**
     * 生成订单号
     * @return string
     */
    public static function generateOrderNo()
    {
        return date('YmdHismw') . mt_rand(10000, 10000000);
    }

    /**
     * 生成8位消费码
     * @return string
     */
    public static function generateConsumeCode()
    {
        $string = date('YmdHisw') . mt_rand(10000, 10000000);
        $string = str_shuffle($string);
        $string = str_shuffle($string);

        return substr($string, 2, 2).substr($string, 5, 2).substr($string, 15, 2).substr($string, 20, 2);

    }
}