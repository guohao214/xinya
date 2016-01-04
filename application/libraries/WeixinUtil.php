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

       public function sendLotteryTemplateMessage($sylOrderNo = '', $openId = '', $productName = '', $wx_accesstoken = '')
    {
        $template = array(
            "touser" => $openId,
            "template_id" => "qeWn-8WEntS62mBxVG1mMIXSUv5vRv7eX9NR44bMjug",
            "url" => Yii::app()->params['host'] . Yii::app()->controller->createUrl('store/index'),
            "topcolor" => "#FF0000",
            "data" => array(
                "first" => array( //描述
                    "value" => "您好，您的中奖商品为：{$productName}，订单号为：{$sylOrderNo}",
                    "color" => "#173177"
                ),

                "keyword1" => array( //购买门店
                    "value" => "思妍丽微商城",
                    "color" => "#173177"
                ),

                "keyword2" => array( //购买时间
                    "value" => date('Y-m-d'),
                    'color' => "#173177"
                ),

                "remark" => array( //备注
                    "value" => "您的中奖商品已与订单号：{$sylOrderNo}绑定，请尽快到门店兑换。击消息查询门店地址",
                    "color" => "#c9151b"
                )
            )
        );

        $data = json_encode($template);

        $url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=' . $wx_accesstoken;

        /**
         * {
         * "errcode":0,
         * "errmsg":"ok",
         * "msgid":200228332
         * }
         */

        $response = $this->postReadApi($url, $data);

        return $response;
    }

    /**
     * 发送模板消息
     *
     * @param $lotteryCode 中奖码
     */
    public function sendTemplateMessage($sylOrderNo = '', $lotteryCode = '', $first = '', $openId = '', $wx_accesstoken = '')
    {
        $template = array(
            "touser" => $openId,
            "template_id" => "2pToA21-ULAImOjZoBxEunX4ldFH6suKPZlwcOToMfc",
            "url" => Yii::app()->params['host'] . Yii::app()->controller->createUrl('game/index', array('lottery_code' => $lotteryCode)),
            "topcolor" => "#FF0000",
            "data" => array(
                "first" => array( //描述
                    "value" => "您好，谢谢购买思妍丽商品：{$first}，您的订单号为：{$sylOrderNo}",
                    "color" => "#173177"
                ),

                "keyword1" => array( //购买门店
                    "value" => "思妍丽微商城",
                    "color" => "#173177"
                ),

                "keyword2" => array( //购买时间
                    "value" => date('Y-m-d'),
                    'color' => "#173177"
                ),

                "remark" => array( //备注
                    "value" => "谢谢购买，您的抽奖码为： $lotteryCode ，请点击消息前去抽奖",
                    "color" => "#c9151b"
                )
            )
        );

        $data = json_encode($template);

        $url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=' . $wx_accesstoken;

        /**
         * {
         * "errcode":0,
         * "errmsg":"ok",
         * "msgid":200228332
         * }
         */

        $response = $this->postReadApi($url, $data);

        return $response;
    }

}