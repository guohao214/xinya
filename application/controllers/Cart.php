<?php

/**
 * 购物车
 * User: GuoHao
 * Date: 2015/12/26
 * Time: 23:31
 */
class Cart extends FrontendController
{
    public function index()
    {
        $cart = (new CartUtil())->cart();
        $projectIds = array_keys($cart);
        $projects = array();
        if (!empty($cart) && !empty($projectIds)) {
            // 查询所有的项目
            $projects = (new ProjectModel())->readByProjectIds($projectIds);
        } else {
            $this->message('购物车为空！');
        }

        $shops = (new ShopModel())->getAllShops();
        $categories = (new CategoryModel())->getAllCategories();
        $this->view('cart/index', array('shops' => $shops, 'projects' => $projects,
            'categories' => $categories, 'cart' => $cart));
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

    public function deleteCart($projectId)
    {
        if (!$projectId)
            $this->message('错误的项目ID');

        $projectId += 0;

        (new CartUtil())->deleteCart($projectId);
        session_write_close();
        ResponseUtil::executeSuccess('从购物车删除成功!');
    }

    /**
     * 下单
     */
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
            ResponseUtil::redirect($weixin->toAuthorize(UrlUtil::createUrl('cart/order')));
        }

        //**********处理下单************//
        $cart = (new CartUtil())->cart();
        $projectIds = array_keys($cart);
        $cartCounts = array_sum($cart);
        $consumeCode = array();

        if (empty($cart) || empty($projectIds)) {
            $this->message('购物车为空！');
        }

        // 生成多少个消费码
        for ($i = 0; $i < $cartCounts; $i++) {
            $generateConsumeCode = StringUtil::generateConsumeCode();
            while (in_array($generateConsumeCode, $consumeCode)) {
                $generateConsumeCode = StringUtil::generateConsumeCode();
            }
            $consumeCode[] = $generateConsumeCode;
        }

        // 生成订单号
        $orderNo = StringUtil::generateOrderNo();
        $orderModel = new OrderModel();
        while ((new CurdUtil($orderModel))->readOne(array('order_no' => $orderNo))) {
            $orderNo = StringUtil::generateOrderNo();
        }

        $orderProjectModel = new OrderProjectModel();

        // 获得购物车的项目
        $projects = (new ProjectModel())->readByProjectIds($projectIds);

        // 事务开始
        $this->db->trans_start();
        foreach ($projects as $project) {
            $projectCounts = $cart[$project['project_id']];
            for ($i = 0; $i < $projectCounts; $i++) {
                $orderData = array(
                    'order_no' => $orderNo,
                    'consume_code' => array_pop($consumeCode),
                    'shop_id' => $project['shop_id'],
                    'create_time' => DateUtil::now(),
                    'total_fee' => $project['price'],
                    'open_id' => $openId,
                    'order_status' => OrderModel::ORDER_NOT_PAY
                );

                $insertOrderNo = (new CurdUtil($orderModel))->create($orderData);

                $orderProjectData = array(
                    'order_id' => $insertOrderNo,
                    'project_id' => $project['project_id'],
                    'project_use_time' => $project['use_time'],
                    'project_price' => $project['price'],
                    'create_time' => DateUtil::now(),
                    'project_name' => $project['project_name'],
                    'project_cover' => $project['project_cover']
                );

                (new CurdUtil($orderProjectModel))->create($orderProjectData);
            }
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->message('提交订单失败，请重试!');
        } else {
            $this->db->trans_commit();
            // 清空购物车
            // 跳到 订单显示
            ResponseUtil::redirect(UrlUtil::createUrl('order/pay/' . $orderNo));
        }
    }
}