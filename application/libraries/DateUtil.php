<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 15-12-16
 * Time: 下午11:43
 */
class DateUtil
{
    public static function now()
    {
        return date('Y-m-d H:i:s');
    }

    /**
     * 检查两个时间差
     * @param $date
     * @param string $now
     */
    public static function orderIsValidDate($date, $subDate = 2, $now = '')
    {
        if (!$now)
            $now = time();

        if (!is_numeric($date))
            $date = strtotime($date);

        $sub = ($now - $date);
        return ($sub < $subDate * 86400);
    }
} 