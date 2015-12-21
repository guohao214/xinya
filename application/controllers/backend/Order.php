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
        $params = $_params = RequestUtil::getParams();
        if ($params) {
            array_walk($params, function(&$item, $key) {
                $item = "{$key} like '%{$item}%'";
            });
        }

        $where = implode('and ', $params);

        $orders = (new CurdUtil($this->orderModel))->readLimit($where, $limit);
        $ordersCount = (new CurdUtil($this->orderModel))->count($where);
        $pages = (new PaginationUtil($ordersCount))->pagination();
        $this->view('order/index', array('orders' => $orders, 'pages' => $pages, 'params' => $_params));
    }

    public function orderDetail()
    {
        $this->view('order/orderDetail');
    }

    /**
     * 下载订单信息
     */
    public function download()
    {

    }
} 