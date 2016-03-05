<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 2016/3/5
 * Time: 15:18
 */
class OfflineOrder extends BackendController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('OfflineOrderModel', 'offlineOrderModel');
    }

    public function index($limit = '')
    {
        // 获得查询参数， 查询参数都为like模糊查询
        $where = RequestUtil::buildLikeQueryParamsWithDisabled();

        $this->db->select('*');
        $orders = (new CurdUtil($this->offlineOrderModel))->readLimit($where, $limit, 'offline_order_id desc');
        $ordersCount = (new CurdUtil($this->offlineOrderModel))->count($where);
        $pages = (new PaginationUtil($ordersCount))->pagination();
        $shops = (new ShopModel())->getAllShops();
        $beauticians = (new BeauticianModel())->getAllFormatBeauticians();
        $this->view('offline/order', array('orders' => $orders, 'pages' => $pages, 'beauticians' => $beauticians,
            'params' => RequestUtil::getParams(), 'shops' => $shops, 'limit' => $limit));
    }

    public function service($orderId)
    {
        $where = array('offline_order_id' => $orderId);
        $data = array(
            'order_status' => OfflineOrderModel::ORDER_SERVICED
        );

        if ((new CurdUtil(new OfflineOrderModel()))->update($where, $data))
            $this->message('修改成功！');
        else
            $this->message('修改失败！');
    }

    public function cancel($orderId)
    {
        $where = array('offline_order_id' => $orderId);
        $data = array(
            'disabled' => 1
        );

        if ((new CurdUtil(new OfflineOrderModel()))->update($where, $data))
            $this->message('删除成功！');
        else
            $this->message('删除失败！');
    }
}