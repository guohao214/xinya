<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 2015/12/30
 * Time: 23:10
 */
class UserUtil
{
    public static $saveSign = '_xinya_backend_login_user';
    public static $verifySign = '_xinya_verify_code';

    public static function saveUser($user)
    {
        $_SESSION[self::$saveSign] = $user;
    }

    public static function getUser()
    {
        return $_SESSION[self::$saveSign];
    }

    public static function getUserName()
    {
        $user = self::getUser();
        return $user['user_name'];
    }

    public static function getUserId()
    {
        $user = self::getUser();
        return $user['user_id'];
    }

    public static function isAdmin()
    {
        $user = self::getUser();
        return ($user['type'] == UserModel::ADMIN);
    }

    public static function isShopKeeper()
    {
        $user = self::getUser();
        return ($user['type'] == UserModel::SHOP_KEEPER);
    }

    public static function setVerifyCode($code)
    {
        $_SESSION[self::$verifySign] = $code;
    }

    public static function getVerifyCode()
    {
        return $_SESSION[self::$verifySign];
    }

}