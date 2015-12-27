<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 2015/12/27
 * Time: 23:04
 */
class Order extends FrontendController
{
    /**
     * 订单支付
     * @param $orderNo
     */
    public function pay($orderNo)
    {
        // 是否授权

        // 获得订单信息
        $where = array('order_no' => $orderNo);

        $orders = (new OrderModel())->getNotPayOrders($where);

        if (!$orders)
            $this->message('订单不存在！');

        $_orders = array();
        $totalAmount = 0;

        foreach($orders as $order) {
            $project_id = $order['project_id'];
            $totalAmount += $order['total_fee'];

            if (isset($_orders[$project_id]))
            {
                $_orders[$project_id]['buy_counts'] += 1;
            } else {
                $_orders[$project_id] = $order;
                $_orders[$project_id]['buy_counts']  = 1;
            }
        }

        // 获得预付款ID

        $this->view('order/pay', array('orders' => $_orders, 'orderNo' => $orderNo, 'totalAmount' => $totalAmount));

    }
}