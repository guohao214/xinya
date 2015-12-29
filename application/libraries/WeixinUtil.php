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
    private $mchId ;
    private $apiKey;
    private $noticeUrl;

    public function __construct($config = 'weixin')
    {
        $weixinConfig = ConfigUtil::loadConfig($config);
        $this->appId = $weixinConfig['appId'];
        $this->appSecret = $weixinConfig['appSecret'];
        $this->mchId = $weixinConfig['mchId'];
        $this->apiKey = $weixinConfig['apiKey'];
        $this->noticeUrl = $weixinConfig['noticeUrl'];
    }

    public function saveAuthorize($accessToken)
    {
        // 保存授权信息的时间
        $accessToken['saveTime'] = time();
        $_SESSION[$this->accessTokenSign] = $accessToken;
    }

    public function getAuthorize()
    {
        return $_SESSION[$this->accessTokenSign];
    }

    public function getOpenId()
    {
        $accessToken = $this->getAuthorize();
        return $accessToken['openid'];
    }

    public function getRefreshToken()
    {
        $accessToken = $this->getAuthorize();
        return $accessToken['refresh_token'];
    }

    public function getAccessToken()
    {
        $accessToken = $this->getAuthorize();
        return $accessToken['access_token'];
    }

    public function getSaveTime()
    {
        $accessToken = $this->getAuthorize();
        return $accessToken['saveTime'];
    }

    /**
     * 是否需要刷新fresh
     */
    public function isNeedRefreshAccessToken()
    {
        $saveTime = $this->getSaveTime();
        // expires_in为7200
        return time() > $saveTime + 7200;
    }

    /**
     * 刷新accessToken
     */
    public function refreshAccessToken()
    {
        $refreshToken = $this->getRefreshToken();
        $refreshUrl = "https://api.weixin.qq.com/sns/oauth2/refresh_token?appid={$this->appId}&grant_type=refresh_token&refresh_token={$refreshToken}";

        $newAuthorize = RequestUtil::get($refreshUrl);
        LogUtil::weixinLog('刷新accessToken：', $newAuthorize);

        if (!$newAuthorize || $newAuthorize['errcode'])
            return false;

        $this->saveAuthorize($newAuthorize);
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

        LogUtil::weixinLog('授权登录：', $accessToken);

        if (!$accessToken || $accessToken['error'])
            return false;

        $this->saveAuthorize($accessToken);
        return true;
    }

}