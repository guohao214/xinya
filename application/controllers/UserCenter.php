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
        $this->view('userCenter/index');
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


    public function xinya($alias)
    {
        $article = (new CurdUtil(new ArticleModel()))
            ->readOne(array('alias_name' => $alias, 'disabled' => 0));

        if (!$article)
            $this->message('信息不存在!');

        $this->view('article/index', array('article' => $article));
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

        //取消订单
        if ((new CurdUtil(new OrderModel()))->update(array('order_id' => $orderId, 'open_id' => $openId),
            array('order_status' => OrderModel::ORDER_CANCEL))
        )
            ResponseUtil::executeSuccess('订单取消成功！');
        else
            ResponseUtil::failure('取消订单失败!');
    }
}