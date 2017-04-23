<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 2016/3/27
 * Time: 1:01
 */
include 'Jssdk.php';

class WxShareUtil
{
    private $appId;
    private $appSecret;
    private $jsSdk;

    public function __construct($config = 'weixin')
    {
        $wxSetting = ConfigUtil::loadConfig($config);

        $this->appId = $wxSetting['appId'];
        $this->appSecret = $wxSetting['appSecret'];

        $this->jsSdk = new JSSDK($this->appId, $this->appSecret);

    }

    public function getShareParams($currentUrl = '')
    {
        return $this->jsSdk->GetSignPackage($currentUrl);
    }
}