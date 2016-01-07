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
    private $mchId;
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
     * 是否需要刷新fresh 5400秒之内不用刷新。
     */
    public function isNeedRefreshAccessToken()
    {
        $saveTime = $this->getSaveTime();
        // expires_in为7200
        return time() > $saveTime + 5400;
    }

    /**
     * 刷新accessToken
     */
    public function refreshAccessToken()
    {
        $refreshToken = $this->getRefreshToken();
        $refreshUrl = "https://api.weixin.qq.com/sns/oauth2/refresh_token?appid={$this->appId}&grant_type=refresh_token&refresh_token={$refreshToken}";
        LogUtil::weixinLog('刷新token链接：', $refreshUrl);
        $newAuthorize = RequestUtil::get($refreshUrl);
        LogUtil::weixinLog('刷新accessToken：', $newAuthorize);

        if (!$newAuthorize || $newAuthorize['errcode'])
            return false;

        $this->saveAuthorize($newAuthorize);
        return true;
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

    /**
     * 获取token信息， 不同于登录验证返回的token
     * @return mixed
     */
    public function getToken()
    {
        $tokenUrl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid="
            . $this->appId . "&secret=" . $this->appSecret;

        $token = RequestUtil::get($tokenUrl);
        LogUtil::weixinLog('获取普通access token：', $token);

        $access_token = '';
        if (isset($token['access_token']))
            $access_token = $token['access_token'];

        return $access_token;
    }

    /**
     * 发送模板消息
     * @param array $message
     * @param $accessToken
     */
    public function templateMessage(array $message, $accessToken)
    {
        $message = json_encode($message);
        $templateUrl = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=' . $accessToken;

        $response = RequestUtil::post($templateUrl, $message);
        LogUtil::weixinLog('通过微信发送订单信息给客户：', $response);

        return $response;
    }

    /**
     * 发送模板消息
     * @param $orderNo
     * @param $consumeCode
     * @param $openId
     * @param $projectName
     * @param $accessToken
     * @return mixed
     */
    public function sendOrderMessage($orderNo, $consumeCode, $openId, $accessToken)
    {
        $message = array(
            "touser" => $openId,
            "template_id" => "Ybj0iaZTeJEwtF1OGBmnDtPCrsXNdEDWRKVmRBCq0iI",
            "url" => UrlUtil::createUrl('userCenter/order'),
            "topcolor" => "#FF0000",
            "data" => array(
                "first" => array( //描述
                    "value" => "您好，谢谢购买不期而遇美容商品，您的订单号为：{$orderNo}, 消费码为：{$consumeCode}",
                    "color" => "#FF8CB3"
                ),

                "keyword1" => array(
                    "value" => "心雅微信商城",
                    "color" => "#173177"
                ),

                "keyword2" => array(
                    "value" => date('Y-m-d'),
                    'color' => "#173177"
                ),

                "remark" => array( //备注
                    "value" => "谢谢购买，有疑问请联系： 13918916779",
                    "color" => "#c9151b"
                )
            )
        );

        return $this->templateMessage($message, $accessToken);
    }

}