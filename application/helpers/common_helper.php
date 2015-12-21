<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-12-21
 * Time: 下午2:05
 */

function clearEmpty($var)
{
    $var = trim($var);

    if ($var != '')
        return $var;
}

function defaultValue($var, $defaultValue = '')
{
    return isset($var) ? $var : $defaultValue;
}