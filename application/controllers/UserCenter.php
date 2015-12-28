<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 2015/12/26
 * Time: 23:39
 */
class UserCenter extends FrontendController
{
    public function index()
    {
        $this->view('userCenter/index');
    }

    public function order()
    {
        // 验证是否已授权
        $weixin = new WeixinUtil();

        // 是否刚授权，刚授权不需要刷新accessToken
        $justAuthorize = false;

        // 如果是微信授权后返回
        if (isset($_GET['code'])) {
            // 获得accessToken
            $callback = $weixin->loginCallback($_GET['code']);
            if (!$callback)
                $this->message('获得微信授权失败，请重试！');
            else
                $justAuthorize = true;
        }

        // 检测是否已经授权
        $openId = $weixin->getOpenId();
        if ($openId) {
            // 刷新token过期
            if (!$justAuthorize) {

            }
        } else {
            // 去微信授权
            ResponseUtil::redirect($weixin->toAuthorize(UrlUtil::createUrl('userCenter/order')));
        }


        $this->view('userCenter/order');
    }
}