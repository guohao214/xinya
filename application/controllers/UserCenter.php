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

    public function order($offset = 0, $orderStatus = 0)
    {
        
        // 验证是否已授权
        $weixin = new WeixinUtil();

        // 如果是微信授权后返回
        if (isset($_GET['code'])) {
            // 获得accessToken
            $callback = $weixin->loginCallback($_GET['code']);
            if (!$callback)
                $this->message('获得微信授权失败，请重试！');
        }

        // 检测是否已经授权
        $openId = $weixin->getOpenId();
        if ($openId) {
            // 刷新token过期
            if ($weixin->isNeedRefreshAccessToken())
                $weixin->refreshAccessToken();
        } else {
            // 去微信授权
            ResponseUtil::redirect($weixin->toAuthorize(UrlUtil::createUrl('userCenter/order')));
        }

        $orderModel = new OrderModel();

        // 获得订单信息
        $where = array('open_id' => $openId);
        if ($orderStatus)
            $where['order_status'] = $orderStatus;

        $orders = $orderModel->userOrders($openId, $orderStatus, $offset);

        $_orders = array();
        foreach ($orders as $order) {
            $_orders[$order['order_no']][] = $order;
        }

        unset($orders, $order);
        $orderCounts = $orderModel->userOrderCounts($openId, $orderStatus);

        if (isset($orderCounts[0]))
            $orderCounts = array_pop($orderCounts);

        $orderCounts = (isset($orderCounts['rowCounts'])) ? $orderCounts['rowCounts'] : 0;
        $pages = (new PaginationUtil($orderCounts, 'user-center'))->pagination();
        $shops = (new ShopModel())->getAllShops();

        $this->view('userCenter/order', array('pages' => $pages, 'orders' => $_orders, 'shops' => $shops, 'offset' => $offset));
    }
}