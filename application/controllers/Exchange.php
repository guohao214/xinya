<?php

/**
 * 兑换
 * User: GuoHao
 * Date: 2016/2/26
 * Time: 22:49
 */
class Exchange extends FrontendController
{
    /**
     * 兑换优惠券
     */
    public function coupon()
    {
        $weixinUtil = new WeixinUtil();
        // 验证是否已授权
      	$weixinUtil->authorize("exchange/coupon");

        $coupons = (new CouponModel())->getAllCoupons();
        $this->view('exchange/coupon', array('coupons' => $coupons));
    }

    /**
     * 领取优惠券
     * @param $couponId
     */
    public function getCoupon($couponId)
    {
        $openId = (new WeixinUtil())->getOpenId();
        if (!$openId)
            ResponseUtil::failure('错误的授权!');

        // 查询是否已经领取优惠券
        if ((new CustomerCouponModel())->readOne($couponId, $openId))
            ResponseUtil::failure('您已经领取了此优惠券！');

        $coupon = (new CouponModel())->readOne($couponId);
        // 剩余数量为0
        if ($coupon['remain_number'] <= 0)
            ResponseUtil::failure('优惠券已领完！');

        $today = date('Y-m-d');
        // 是否到领取时间
        if ($today < $coupon['start_time'])
            ResponseUtil::failure('优惠券未到领取时间！');

        if ($today > $coupon['expire_time'])
            ResponseUtil::failure('优惠券已到期！');

        // 判断积分
        $customerModel = new CustomerModel();
        $customer = $customerModel->readOne($openId);
        if ($coupon['exchange_credits'] > $customer['credits'])
            ResponseUtil::failure('积分不足，优惠券领取失败！');

        $this->db->trans_start();
        // 领取
        $data = array(
            'coupon_id' => $couponId,
            'open_id' => $openId,
            'get_coupon_time' => DateUtil::now()
        );
        $customerCouponId = (new CustomerCouponModel())->create($data);

        if ($customerCouponId)
            (new CouponModel())->subCouponNumber($couponId);

        // 积分
        $customerModel->subCredits($openId, $coupon['exchange_credits']);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            ResponseUtil::failure('领取优惠券失败！');
        } else {
            $this->db->trans_commit();
            ResponseUtil::executeSuccess('领取优惠券成功!');
        }
    }

    public function exchangeGoods()
    {
     	$weixinUtil = new WeixinUtil();
        // 验证是否已授权
     	$weixinUtil->authorize("exchange/coupon");
        $openId = $weixinUtil->getOpenId();
        $products = (new ExchangeGoodsModel())->getAllExchangeGoods();
        $shops = (new ShopModel())->getAllShopAddress();
        $lastOrder = (new OrderModel())->getLastOrder($openId);
        $this->view('exchange/exchangeGoods',
            array('products' => $products, 'shops' => $shops, 'lastOrder' => $lastOrder));
    }

    public function getExchangeGoods($exchangeGoodsId)
    {
        $openId = (new WeixinUtil())->getOpenId();
        if (!$openId)
            ResponseUtil::failure('错误的授权!');

        // 查询是否已经领取优惠券
        if ((new CustomerExchangeGoodsModel())->readOne($exchangeGoodsId, $openId))
            ResponseUtil::failure('您已经兑换了此商品！');

        $exchangeGoods = (new ExchangeGoodsModel())->readOne($exchangeGoodsId);
        // 剩余数量为0
        if ($exchangeGoods['remain_number'] <= 0)
            ResponseUtil::failure('商品已经兑换完！');

        $today = date('Y-m-d');
        // 是否到领取时间
        if ($today < $exchangeGoods['start_time'])
            ResponseUtil::failure('商品未到兑换时间！');

        if ($today > $exchangeGoods['expire_time'])
            ResponseUtil::failure('商品已过兑换时间！');

        // 判断积分
        $customerModel = new CustomerModel();
        $customer = $customerModel->readOne($openId);
        if ($exchangeGoods['exchange_credits'] > $customer['credits'])
            ResponseUtil::failure('积分不足，兑换商品失败！');

        $userName = $this->input->post('contact_name', true);
        $phoneNumber = $this->input->post('contact_phone', true);

        $userName = urldecode($userName);
        // 检查用户
        $userName = trim(strip_tags($userName));
        if (empty($userName))
            ResponseUtil::failure('联系人不能为空，请检查！');

        if (!preg_match('~^1\d{10}$~', $phoneNumber))
            ResponseUtil::failure('手机号错误，请检查！');

        $this->db->trans_start();
        // 领取
        $data = array(
            'exchange_goods_id' => $exchangeGoodsId,
            'open_id' => $openId,
            'is_get' => 0,
            'contact_name' => $userName,
            'contact_phone' => $phoneNumber,
            'exchange_time' => DateUtil::now()
        );

        $customerExchangeGoodsId = (new CustomerExchangeGoodsModel())->create($data);

        if ($customerExchangeGoodsId)
            (new ExchangeGoodsModel())->subExchangeGoodsNumber($exchangeGoodsId);

        // 积分
        $customerModel->subCredits($openId, $exchangeGoods['exchange_credits']);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            ResponseUtil::failure('兑换商品失败！');
        } else {
            $this->db->trans_commit();
            ResponseUtil::executeSuccess('兑换商品成功!');
        }
    }
}