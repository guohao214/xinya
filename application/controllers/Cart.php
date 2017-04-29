<?php

/**
 * 购物车
 * User: GuoHao
 * Date: 2015/12/26
 * Time: 23:31
 */
class Cart extends FrontendController
{
    /**
     * 购物车首页，需要微信授权
     */
    public function index()
    {
        // 验证是否已授权
        /**$weixin = new WeixinUtil();
         *
         * // 如果是微信授权后返回
         * if (isset($_GET['code'])) {
         * // 获得accessToken
         * $callback = $weixin->loginCallback($_GET['code']);
         * if (!$callback)
         * $this->message('获得微信授权失败，请重试！');
         * }
         *
         * // 检测是否已经授权
         * $openId = $weixin->getOpenId();
         * if ($openId) {
         * // 刷新token过期
         * if ($weixin->isNeedRefreshAccessToken())
         * if (!$weixin->refreshAccessToken()) {
         * ResponseUtil::redirect($weixin->toAuthorize(UrlUtil::createUrl('cart/index')));
         * }
         * } else {
         * // 去微信授权
         * ResponseUtil::redirect($weixin->toAuthorize(UrlUtil::createUrl('cart/index')));
         * }
         *
         * $cart = (new CartUtil())->cart();
         * $projectIds = array_keys($cart);
         * $projects = array();
         * if (!empty($cart) && !empty($projectIds)) {
         * // 查询所有的项目
         * $projects = (new ProjectModel())->readByProjectIds($projectIds);
         * } else {
         * $this->message('购物车为空！');
         * }
         *
         * $shops = (new ShopModel())->getAllShops();
         * $categories = (new CategoryModel())->getAllCategories();
         * $this->view('cart/index', array('shops' => $shops, 'projects' => $projects,
         * 'categories' => $categories, 'cart' => $cart));*/
    }

    public function addCart($projectId)
    {
        if (!$projectId)
            $this->message('错误的项目ID');

        $projectId += 0;

        (new CartUtil())->addCart($projectId);
        session_write_close();
        ResponseUtil::executeSuccess('添加到购物车成功!');
    }

    /**
     * 删除购物车商品， 此一版不需要
     * @param $projectId
     * @return bool
     */
    public function deleteCart($projectId)
    {
        /**if (!$projectId)
         * $this->message('错误的项目ID');
         *
         * $projectId += 0;
         *
         * (new CartUtil())->deleteCart($projectId);
         * session_write_close();
         * ResponseUtil::executeSuccess('从购物车删除成功!');*/
    }

    /**
     * 下单
     * @param $shopId
     * @param $beauticianId
     * @param $appointmentDay
     * @param $appointmentTime
     * @param $userName
     * @param $phoneNumber
     */
    public function order($shopId, $beauticianId, $appointmentDay, $appointmentTime, $userName, $phoneNumber)
    {
        $openId = (new WeixinUtil())->getOpenId();
        if (!$openId)
            $this->message('错误的授权');

        if (!(new ShopModel())->isValidShopId($shopId))
            $this->message('门店信息错误，请检查！');


        // 检查美容师
        if (!(new BeauticianModel())->isValidBeautician($beauticianId))
            $this->message('美容师信息错误，请检查！');

        $userName = urldecode($userName);
        // 检查用户
        $userName = trim(strip_tags($userName));
        if (empty($userName))
            $this->message('联系人不能为空，请检查！');

        if (!preg_match('~^1\d{10}$~', $phoneNumber))
            $this->message('手机号错误，请检查！');

        // 检查日期，日期为今天或者以后
        $today = date('Y-m-d');
        if ($appointmentDay < $today)
            $this->message('错误的预约日期！');

        // 检查时间
        $appointmentTime = explode(',', urldecode($appointmentTime));
        if (!$appointmentTime || count($appointmentTime) < 1)
            $this->message('错误的预约时间！');

        // 只有30分钟的项目
        if (count($appointmentTime) == 1)
            array_push($appointmentTime, $appointmentTime[0]);

        // 只保留头和尾的两个数据
        $startTime = array_shift($appointmentTime);
        $endTime = array_pop($appointmentTime);
        if ($endTime < $startTime)
            $this->message('错误的预约时间！');

        // 预约时间是否小于当前时间
        $now = date('Y-m-d H:i');
        if (DateUtil::buildDateTime($appointmentDay, $startTime) < $now)
            $this->message('错误的预约开始时间！');

        if (DateUtil::buildDateTime($appointmentDay, $endTime) < $now)
            $this->message('错误的预约结束时间！');


        // 结束时间 + 30分钟为真正的结束时间
        //$timeStamp = DateUtil::buildDateTime($appointmentDay, $endTime);
        //$timeStamp += 1800;
        //$endTime = date('H:i', $timeStamp);


        // 处理优惠
        $couponId = $this->input->get('coupon_id', true) + 0;
        $couponCode = $this->input->get('coupon_code', true) + 0;
        $customerCouponModel = new CustomerCouponModel();
        $couponCodeModel = new CouponCodeModel();
        $today = date('Y-m-d');

        if ($couponId) {
            $couponCode = '';
            $coupon = $customerCouponModel->readOneById($couponId);
            // 判断是否能使用
            if ($coupon['is_use'] == 1)
                $this->message('选择的优惠券已被使用！');

            // 是否到领取时间
            if ($today < $coupon['start_time'])
                $this->message('优惠券未到使用时间！');

            if ($today > $coupon['expire_time'])
                $this->message('优惠券已到期！');

        } else if ($couponCode) {
            $couponId = '';
            $queryCouponCode = $couponCodeModel->readOneByCode($couponCode);
            if (!$queryCouponCode)
                $this->message('优惠码不存在！');

            // 是否到使用时间
            if ($today < $queryCouponCode['start_time'])
                $this->message('优惠码未到使用时间！');

            // 是有已过期
            if ($today > $queryCouponCode['expire_time'])
                $this->message('优惠码已到期！');

        } else {
        }

        //**********处理下单************//
        $projectId = (new CartUtil())->cart();

        if (empty($projectId) || $projectId <= 0) {
            $this->message('预约项目为空！');
        }


        if ((new ProjectPropertyModel())->projectOnlyForNewUser($projectId, $openId))
            $this->message('此美容项目只针对新用户！');


        $orderProjectModel = new OrderProjectModel();
        // 获得购物车的项目
        $project = (new ProjectModel())->readOne($projectId);

        // 判断订单金额是否可以使用优惠券
        $totalFee = $originalTotalFee = $project['price'];
        if ($couponId && $project['can_use_coupon']) {
            if ($totalFee < $coupon['use_rule'])
                $this->message('当前订单金额不足' . $coupon['use_rule'] . '元，不能使用此优惠券');
        } else if ($couponCode && $project['can_use_coupon_code']) {
            if ($totalFee < $queryCouponCode['use_rule'])
                $this->message('当前订单金额不足' . $queryCouponCode['use_rule'] . '元，不能使用此优惠码');
        } else {
        }

        // 生成订单号, 有重复订单号则重新生成，直到不重复为止
        $orderNo = StringUtil::generateOrderNo();
        $orderModel = new OrderModel();
        while ((new CurdUtil($orderModel))->readOne(array('order_no' => $orderNo))) {
            $orderNo = StringUtil::generateOrderNo();
        }

        // 优惠
        if ($couponId && $project['can_use_coupon']) {
            // 使用优惠码， 抵消金额
            $totalFee -= $coupon['counteract_amount'];
        } else if ($couponCode && $project['can_use_coupon_code']) {
            $totalFee *= $queryCouponCode['discount'];
        } else {
        }

        // 订单数据
        $orderData = array(
            'order_no' => $orderNo,
            'shop_id' => $shopId,
            'create_time' => DateUtil::now(),
            'original_total_fee' => $originalTotalFee,
            'total_fee' => $totalFee,
            'open_id' => $openId,
            'order_status' => OrderModel::ORDER_NOT_PAY,
            'beautician_id' => $beauticianId,
            'appointment_day' => $appointmentDay,
            'appointment_start_time' => $startTime,
            'appointment_end_time' => $endTime,
            'user_name' => $userName,
            'phone_number' => $phoneNumber,
            'use_coupon_id' => $couponId,
            'use_coupon_code' => $couponCode
        );

        // 事务开始
        $this->db->trans_start();

        // 设置优惠券已使用
        if ($couponId && $project['can_use_coupon'])
            $customerCouponModel->useCoupon($couponId, $openId);
        else if ($couponCode && $project['can_use_coupon_code']) {
            $couponCodeModel->addUseTimes($couponCode);
        } else {
        }

        $insertOrderNo = (new CurdUtil($orderModel))->create($orderData);
        if ($insertOrderNo) {
            $orderProjectData = array(
                'order_id' => $insertOrderNo,
                'project_id' => $project['project_id'],
                'project_use_time' => $project['use_time'],
                'project_price' => $project['price'],
                'create_time' => DateUtil::now(),
                'project_name' => $project['project_name'],
                'project_cover' => $project['project_cover']
            );
        } else {
            $this->message('提交订单失败，请重试！');
        }

        (new CurdUtil($orderProjectModel))->create($orderProjectData);


        // 创建分享订单
        $shareFrom = ShareUtil::getShareFrom();
        if (!is_array($shareFrom))
            $shareFrom = [];
        //
        $makerOrderModel = new MakerOrderModel();
        for ($i = 0; $i < count($shareFrom); $i++) {
            if ($shareFrom[$i] == $openId)
                continue;


            if ($shareFrom[$i] == '')
                continue;

            $data['mk_open_id'] = $shareFrom[$i];
            $data['buyer_open_id'] = $openId;
            $data['order_no'] = $orderNo;
            $data['order_amount'] = $totalFee;
            $data['order_earnings_percent'] = EarningsPercentUtil::getPercent($totalFee);

            $makerOrderModel->create($data);
        }


        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->message('提交订单失败，请重试!');
        } else {
            $this->db->trans_commit();
            // 清空购物车
            (new CartUtil())->emptyCart();
            // 跳到 订单显示
            ResponseUtil::redirect(UrlUtil::createUrl('order/pay/' . $orderNo));
        }
    }
}