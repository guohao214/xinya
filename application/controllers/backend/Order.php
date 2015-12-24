<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 15-12-14
 * Time: 下午10:52
 */
class Order extends BackendController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('OrderModel', 'orderModel');
    }

    public function index($limit = '')
    {
        // 获得查询参数， 查询参数都为like模糊查询
        $where = RequestUtil::likeParamsWithDisabled();

        $orders = (new CurdUtil($this->orderModel))->readLimit($where, $limit);
        $ordersCount = (new CurdUtil($this->orderModel))->count($where);
        $pages = (new PaginationUtil($ordersCount))->pagination();
        $shops = (new ShopModel())->getAllShops();
        $this->view('order/index', array('orders' => $orders, 'pages' => $pages,
            'params' => RequestUtil::getParams(), 'shops' => $shops));
    }

    public function orderDetail($order_id = '')
    {
        if (!$order_id)
            $this->message('订单ID不能为空！');

        $order = (new CurdUtil($this->orderModel))->readOne(array('order_id' => $order_id, 'disabled' => 0));
        if (!$order)
            $this->message('订单信息获取失败，请重试！');

        // 获得订单商品
        $orderProjects = (new OrderProjectModel())->getOrderProject($order_id);
        $shops = (new ShopModel())->getAllShops();
        $this->view('order/orderDetail', array('order' => $order, 'shops' => $shops,
            'orderProjects' => $orderProjects));
    }

    /**
     * 删除订单
     * @param string $order_id
     */
    public function deleteOrder($order_id = '')
    {
        if (!$order_id)
            $this->message('订单ID不能为空！');

        if ((new CurdUtil($this->orderModel))->update(array('order_id' => $order_id), array('disabled' => 1)))
            $this->message('订单删除成功！', 'order/index');
        else
            $this->message('订单删除失败！', 'order/index');
    }

    /**
     * 下载订单信息
     */
    public function download()
    {

    }
} 