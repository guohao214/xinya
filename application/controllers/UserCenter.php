<?php

/**
 * 个人中心
 * User: GuoHao
 * Date: 2015/12/26
 * Time: 23:39
 */
class UserCenter extends FrontendController
{
    public function index()
    {
        // 授权
        $weixinUtil = new WeixinUtil();
        $weixinUtil->authorize("userCenter/index");
        $openId = $weixinUtil->getOpenId();
        $customer = (new CustomerModel())->readOne($openId);
        $this->view('userCenter/index', array('customer' => $customer));
    }

    public function order($offset = 0)
    {
        $orderStatus = $this->input->get('type') + 0;

        $weixinUtil = new WeixinUtil();
        $weixinUtil->authorize("userCenter/order/{$offset}/{$orderStatus}");

        $openId = $weixinUtil->getOpenId();
        $orderModel = new OrderModel();

        // 获得订单信息
        $where = array('open_id' => $openId);
        if ($orderStatus)
            $where['order_status'] = $orderStatus;

        $orders = $orderModel->getUserOrders($openId, $orderStatus, $offset);

        $orderCounts = $orderModel->getUserOrderCounts($openId, $orderStatus);

        if (isset($orderCounts[0]))
            $orderCounts = array_pop($orderCounts);

        $orderCounts = (isset($orderCounts['rowCounts'])) ? $orderCounts['rowCounts'] : 0;
        $pages = (new PaginationUtil($orderCounts, 'user-center'))->pagination();

        $shopModel = new ShopModel();
        $shops = $shopModel->getAllShops();
        $shopAddress = $shopModel->getAllShopAddress();
        $this->view('userCenter/order', array('pages' => $pages, 'orders' => $orders, 'orderStatus' => $orderStatus,
            'shops' => $shops, 'offset' => $offset, 'shopAddress' => $shopAddress));
    }

    /**
     * 取消订单
     * @param $orderId
     */
    public function cancelOrder($orderId)
    {
        $openId = (new WeixinUtil())->getOpenId();
        if (!$openId)
            ResponseUtil::failure('未授权访问！');

        if (!$orderId)
            ResponseUtil::failure('没有订单');

        $orderId += 0;

        $orderModel = new OrderModel();
        // 获得订单
        $order = $orderModel->readOne($orderId);
        if (!$order)
            ResponseUtil::failure('取消订单失败!');

        // 获得积分ID
        $couponId = $order['use_coupon_id'];
        if ($couponId)
            (new CustomerCouponModel())->refundCoupon($couponId, $openId);

        //取消订单
        if ((new CurdUtil(new OrderModel()))->update(array('order_id' => $orderId, 'open_id' => $openId),
            array('order_status' => OrderModel::ORDER_CANCEL))
        ) {
            ResponseUtil::executeSuccess('订单取消成功！');
        } else
            ResponseUtil::failure('取消订单失败!');
    }

    /**
     * 领取的优惠券
     * @param $offset
     */
    public function coupon($offset = 0)
    {
        $openId = (new WeixinUtil())->getOpenId();
        if (!$openId)
            $this->message('未授权访问！');

        $customerCoupon = new CustomerCouponModel();
        $coupons = $customerCoupon->getCustomerCouponList($openId, $offset);
        $couponsCount = $customerCoupon->getCustomerCouponCount($openId);
        $pages = (new PaginationUtil($couponsCount, 'user-center'))->pagination();

        $this->view('userCenter/coupon', array('coupons' => $coupons, 'pages' => $pages));
    }

    public function exchangeGoods($offset = 0)
    {
        $openId = (new WeixinUtil())->getOpenId();
        if (!$openId)
            $this->message('未授权访问！');

        $customerExchangeGoodsModel = new CustomerExchangeGoodsModel();
        $exchangeGoods = $customerExchangeGoodsModel->getCustomerExchangeGoodsList($openId, $offset);
        $exchangeGoodsCount = $customerExchangeGoodsModel->getCustomerExchangeGoodsCount($openId);
        $pages = (new PaginationUtil($exchangeGoodsCount, 'user-center'))->pagination();
        $shops = (new ShopModel())->getAllShopAddress();

        $this->view('userCenter/exchangeGoods',
            array('exchangeGoods' => $exchangeGoods, 'pages' => $pages, 'shops' => $shops));
    }
}