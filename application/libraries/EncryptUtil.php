<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 2017/4/10
 * Time: 23:19
 */
class EncryptUtil
{
    const ENCRYPT_KEY = "XiTo74dOO09N48YeUmuvbL0E";

    public static function _auth($string, $operation = 'DECODE')
    {

        if ($operation == 'DECODE')
            $string = base64_decode(urldecode($string));

        $str = '';          // 处理后的字符串
        $keylen = strlen(self::ENCRYPT_KEY); // 密钥长度
        $index = 0;
        $stringLength = strlen($string);

        while($index<$stringLength){
            $tmp = $string{$index};

            $str .= $tmp ^ substr(self::ENCRYPT_KEY,$index%$keylen,1);
            $index++;
        }

        if ($operation == 'DECODE')
            return $str;
        else
            return urlencode(base64_encode($str));

    }

    // Encrypting
    public static function encrypt($string)
    {
        return self::_auth($string, 'ENCODE');
    }

    // Decrypting
    public static function decrypt($string)
    {
        return self::_auth($string, 'DECODE');
    }
}