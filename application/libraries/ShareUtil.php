<?php

class ShareUtil
{
    const SESSION_SHARE_NAME = 'last_share_from';

    public static function getShareFrom()
    {
        return $_SESSION[self::SESSION_SHARE_NAME];
    }

    public static function clearShareForm()
    {
        $_SESSION[self::SESSION_SHARE_NAME] = null;
        unset($_SESSION[self::SESSION_SHARE_NAME]);
    }

    public static function setShareFrom($shareFrom)
    {
        $_SESSION[self::SESSION_SHARE_NAME] = $shareFrom;
    }

    public static function getShareUrl() {
        $openId = (new WeixinUtil())->getOpenId();

        if (!(new MakerModel())->isExists($openId))
            return UrlUtil::createUrl('project/index');

        $shareForm = self::getShareFrom();
        if ($shareForm) {
            // 加密
            array_walk($shareForm, function (&$item) {
                if ($item)
                    $item = EncryptUtil::encrypt($item);
            });

            $shareParams['f'] = array_shift($shareForm);
            $shareParams['s'] = array_shift($shareForm);
            $shareParams['b'] = array_shift($shareForm);

        } else {
            $shareParams['f'] = EncryptUtil::encrypt($openId);
        }

        $shareParams = http_build_query($shareParams);

        return UrlUtil::createUrl("share/index?{$shareParams}");
    }
}