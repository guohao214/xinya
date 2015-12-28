<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 2015/12/28
 * Time: 22:06
 */
class WeixinUtil
{
    private $appId;
    private $appSecret;
    private $accessTokenSign = '_weixin_accesstoken';

    public function __construct($config = 'weixin')
    {
        $weixinConfig = ConfigUtil::loadConfig($config);
        $this->appId = $weixinConfig['appId'];
        $this->appSecret = $weixinConfig['appSecret'];
    }

    public function saveAccessToken($accessToken)
    {
        $_SESSION[$this->accessTokenSign] =  $accessToken;
    }

    public function getAccessToken()
    {
        return $_SESSION[$this->accessTokenSign];
    }

    public function getOpenId()
    {
        $accessToken = $this->getAccessToken();
        return $accessToken['openid'];
    }

    /**
     * 跳转微信授权
     */
    public function toAuthorize($callback)
    {
        return "https://open.weixin.qq.com/connect/oauth2/authorize?" .
        "appid={$this->appId}&redirect_uri={$callback}&response_type=code&" .
        "scope=snsapi_userinfo&state=STATE#wechat_redirect";
    }

    /**
     * 检测微信登录
     */
    public function loginCallback($code)
    {
        if (!$code)
            return false;

        $accessTokenUrl = "https://api.weixin.qq.com/sns/oauth2/access_token?" .
            "appid={$this->appId}&secret={$this->appSecret}&code={$code}&grant_type=authorization_code";

        $accessToken = RequestUtil::get($accessTokenUrl);

        if ($accessToken['error'])
            return false;

        $this->saveAccessToken($accessToken);
        return true;
    }

}