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
        $weixin = new WeixinUtil();
        $openId = $weixin->getOpenId();
        if (!$openId)
            $this->message('错误的授权!');

        // 获得订单信息
        $where = array('order_no' => $orderNo, 'open_id' => $openId);

        $orders = (new OrderModel())->getOrder($where, OrderModel::ORDER_NOT_PAY);

        if (!$orders)
            $this->message('订单不存在！');

        if (!isset($orders[0])) {
            $this->message('订单不存在！');
        }

        if ($orders[0]['order_status'] == OrderModel::ORDER_PAYED)
            $this->message('订单已经支付！');

        // 订单时间
        if (!DateUtil::orderIsValidDate($orders[0]['create_time']))
            $this->message('订单已经过期!');

        $_orders = array();
        $totalAmount = 0;

        foreach ($orders as $order) {
            $project_id = $order['project_id'];
            $totalAmount += $order['total_fee'];

            if (isset($_orders[$project_id])) {
                $_orders[$project_id]['buy_counts'] += 1;
            } else {
                $_orders[$project_id] = $order;
                $_orders[$project_id]['buy_counts'] = 1;
            }
        }

        // 获得预付款ID
        $weixinPay = new WeixinPayUtil();
        $prePayId = $weixinPay->fetchPrepayId($openId, '购买不期而遇美容产品', $orderNo, $totalAmount);
        LogUtil::weixinLog('预付款ID：', $prePayId);
        if (!$prePayId)
            $this->message('获得微信预付款ID失败，请重试！');

        //生成支付参数
        $payParams = $weixinPay->getParameters($prePayId);
        LogUtil::weixinLog('支付参数：', $payParams);

        $this->view('order/pay', array('orders' => $_orders, 'payParams' => $payParams,
            'orderNo' => $orderNo, 'totalAmount' => $totalAmount));

    }

    /**
     * 微信支付后的异步回调
     */
    public function notice()
    {
        $weixin = new WeixinPayUtil();

        //通知微信
        $notice = $weixin->notifyData();
        // 签名成功， 返回数组， 否则返回xml数据
        if (!is_array($notice) || !isset($notice['transaction_id']))
            exit($notice);

        //签名成功，处理数据

        /**
         * 返回的数据
         * 'appid' => string 'wxf5b5e87a6a0fde94' (length=18)
         * 'bank_type' => string 'CFT' (length=3)
         * 'fee_type' => string 'CNY' (length=3)
         * 'is_subscribe' => string 'N' (length=1)
         * 'mch_id' => string '10000097' (length=8)
         * 'nonce_str' => string 'dz8nirk7gmxhhxn38zgib28yx14ul2gf' (length=32)
         * 'openid' => string 'ozoKAt-MmA74zs7MBafCix6Dg8o0' (length=28)
         * 'out_trade_no' => string 'wxf5b5e87a6a0fde941409708791' (length=28)
         * 'result_code' => string 'SUCCESS' (length=7)
         * 'return_code' => string 'SUCCESS' (length=7)
         * 'sign' => string 'EDACA525F6C675337B2DAC25B7145028' (length=32)
         * 'sub_mch_id' => string '10000097' (length=8)
         * 'time_end' => string '20140903094659' (length=14)
         * 'total_fee' => string '1' (length=1)
         * 'trade_type' => string 'NATIVE' (length=6)
         * 'transaction_id' => string '1004400737201409030005091526' (length=28)  //微信支付单号
         */

//        $notice  = array(
//            'out_trade_no' => '201512271710391206225994',
//            'transaction_id' => '1004400737201409030005091526'
//        );

        $orderNo = $notice['out_trade_no'];
        $wxOrderNo = $notice['transaction_id'];

        $orderModel = new OrderModel();
        // 获得订单
        $orders = $orderModel->orders(array('order_no' => $orderNo));
        if (!$orders)
            exit($weixin->notifyFailure());

        // 判断是否已经支付
        $order = array_pop($orders);
        if ($order['order_sign'] == OrderModel::ORDER_PAYED)
            exit($weixin->notifyPayed());

        //更新订单信息
        $this->db->trans_start();
        $orderModel->payed($orderNo, $wxOrderNo);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            exit($weixin->notifyFailure());
        } else {
            $this->db->trans_commit();
            exit($weixin->notifySuccess());
        }
    }

}