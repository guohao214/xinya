<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 2015/12/24
 * Time: 23:29
 */
class StringUtil
{
    public function __construct()
    {
        return true;
    }

    public function substr($string, $length = 10)
    {
        return mb_substr($string, 0, $length);
    }
}