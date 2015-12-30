<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 2015/12/29
 * Time: 23:18
 */
class WeixinPayUtil
{
    public $appId;
    public $appSecret;
    public $mchId;
    public $apiKey;
    public $noticeUrl;

    public function __construct($config = 'weixin')
    {
        $weixinConfig = ConfigUtil::loadConfig($config);

        $this->appId = $weixinConfig['appId'];
        $this->appSecret = $weixinConfig['appSecret'];
        $this->mchId = $weixinConfig['mchId'];
        $this->apiKey = $weixinConfig['apiKey'];
        $this->noticeUrl = $weixinConfig['noticeUrl'];

        include 'WxPayPubHelper/WxPayPubHelper.php';
    }

    /**
     * 通过统一支付接口 获得预付款ID
     */
    public function fetchPrepayId($wxOpenId, $body, $orderNo, $totalFee)
    {
        $unifiedOrder = new UnifiedOrder_pub($this);

        //设置统一支付接口参数
        $unifiedOrder->setParameter("openid", $wxOpenId); //微信用户openId
        $unifiedOrder->setParameter("body", $body); //商品描述
        $unifiedOrder->setParameter("out_trade_no", $orderNo); //商户订单号
        $unifiedOrder->setParameter("total_fee", $totalFee * 100); //总金额
        $unifiedOrder->setParameter("notify_url", $this->noticeUrl); //通知地址
        $unifiedOrder->setParameter("trade_type", "JSAPI"); //交易类型

        $prepay_id = $unifiedOrder->getPrepayId();

        return $prepay_id;
    }

    /**
     *    作用：设置jsapi的参数
     */
    public function getParameters($prepay_id)
    {
        $commonUtil = new Common_util_pub($this);

        $jsApiObj["appId"] = $this->appId;
        $timeStamp = time();
        $jsApiObj["timeStamp"] = "{$timeStamp}";
        $jsApiObj["nonceStr"] = $commonUtil->createNoncestr();
        $jsApiObj["package"] = "prepay_id={$prepay_id}";
        $jsApiObj["signType"] = "MD5";
        $jsApiObj["paySign"] = $commonUtil->getSign($jsApiObj);

        return json_encode($jsApiObj);
    }


    /**
     *  获得支付后推送的异步通知数据
     */
    public function notifyData()
    {
        $notify = new Notify_pub($this);

        $xml = $GLOBALS['HTTP_RAW_POST_DATA'];

        $notify->saveData($xml);

        LogUtil::weixinLog('异步回调参数：', $notify->data);

        if ($notify->checkSign() == FALSE) {
            $notify->setReturnParameter("return_code", "FAIL"); //返回状态码
            $notify->setReturnParameter("return_msg", "签名失败"); //返回信息
            return $notify->returnXml();
        }

        return $notify->data;

    }

    /**
     * 处理失败返回
     */
    public function notifyFailure()
    {
        $notify = new Notify_pub($this);
        $notify->setReturnParameter("return_code", "FAIL"); //返回状态码
        $notify->setReturnParameter("return_msg", "处理失败"); //返回信息

        return $notify->returnXml();

    }

    /**
     * 已经支付
     *
     * @return string
     */
    public function notifyPayed()
    {
        $notify = new Notify_pub($this);
        $notify->setReturnParameter("return_code", "SUCCESS"); //返回状态码
        $notify->setReturnParameter("return_msg", "已经支付"); //返回信息

        return $notify->returnXml();

    }

    /**
     * 处理成功返回
     */
    public function notifySuccess()
    {
        $notify = new Notify_pub();
        $notify->setReturnParameter("return_code", "SUCCESS"); //设置返回码
        $notify->setReturnParameter("return_msg", "处理成功"); //返回信息

        return $notify->returnXml();
    }

}