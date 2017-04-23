<?php

/**
 * Class EarningsOrder
 * 提成订单
 */
class EarningsOrder extends BackendController
{
    /**
     * 设置提成
     * @param $offset
     */
    public function index($offset = 0)
    {
        $earningsOrders = (new EarningsOrderModel())->getList($offset);
        $pages = (new PaginationUtil(30))->pagination();
        $this->view('earningsOrder/index', array('orders' => $earningsOrders, 'pages' => $pages,
            'params' => RequestUtil::getParams(),  'limit' => $offset));
    }
}