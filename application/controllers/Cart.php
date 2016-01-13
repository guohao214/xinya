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
     */
    public function order($shopId, $beauticianId, $appointmentDay, $appointmentTime)
    {
        $openId = (new WeixinUtil())->getOpenId();
        if (!$openId)
            $this->message('错误的授权');

        if (!(new ShopModel())->isValidShopId($shopId))
            $this->message('门店信息错误，请检查！');

        // 检查美容师
        if (!(new BeauticianModel())->isValidBeautician($beauticianId))
            $this->message('美容师信息错误，请检查！');

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


        //**********处理下单************//
        $projectId = (new CartUtil())->cart();

        if (empty($projectId) || $projectId <= 0) {
            $this->message('购物车为空！');
        }

        // 生成订单号, 有重复订单号则重新生成，直到不重复为止
        $orderNo = StringUtil::generateOrderNo();
        $orderModel = new OrderModel();
        while ((new CurdUtil($orderModel))->readOne(array('order_no' => $orderNo))) {
            $orderNo = StringUtil::generateOrderNo();
        }

        $orderProjectModel = new OrderProjectModel();

        // 获得购物车的项目
        $project = (new ProjectModel())->readOne($projectId);

        // 订单数据
        $orderData = array(
            'order_no' => $orderNo,
            'shop_id' => $shopId,
            'create_time' => DateUtil::now(),
            'total_fee' => $project['price'],
            'open_id' => $openId,
            'order_status' => OrderModel::ORDER_NOT_PAY,
            'beautician_id' => $beauticianId,
            'appointment_day' => $appointmentDay,
            'appointment_start_time' => $startTime,
            'appointment_end_time' => $endTime
        );

        // 事务开始
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

        $this->db->trans_start();
        (new CurdUtil($orderProjectModel))->create($orderProjectData);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->message('提交订单失败，请重试!');
        } else {
            $this->db->trans_commit();
            // 清空购物车
            //(new CartUtil())->emptyCart();
            // 跳到 订单显示
            ResponseUtil::redirect(UrlUtil::createUrl('order/pay/' . $orderNo));
        }
    }
}