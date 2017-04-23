<?php

class ShareUtil
{
    const SESSION_SHARE_NAME = 'last_share_from';

    public static function getShareFrom()
    {
        return $_SESSION[self::SESSION_SHARE_NAME];
    }

    public static function setShareFrom($shareFrom)
    {
        $_SESSION[self::SESSION_SHARE_NAME] = $shareFrom;
    }

    public static function getShareUrl() {
        $shareForm = self::getShareFrom();
        $openId = (new WeixinUtil())->getOpenId();

        if ($shareForm) {
            // 加密
            array_walk($shareForm, function (&$item) {
                if ($item)
                    $item = EncryptUtil::encrypt($item);
            });

            $shareParams = join('/', $shareForm);

        } else {
            $shareParams = EncryptUtil::encrypt($openId);
        }

        return UrlUtil::createUrl("makers/share/{$shareParams}");
    }
}