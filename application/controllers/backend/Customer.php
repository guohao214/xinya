<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 15-12-14
 * Time: 下午10:52
 */
class Customer extends BackendController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('CustomerModel', 'customerModel');
    }

    public function index($limit = '')
    {
        // 获得查询参数， 查询参数都为like模糊查询
        $where = RequestUtil::buildLikeQueryParamsWithDisabled();
        $this->db->select('*');
        $customers = (new CurdUtil($this->customerModel))->readLimit($where, $limit, 'customer_id desc');
        $customersCount = (new CurdUtil($this->customerModel))->count($where);
        $pages = (new PaginationUtil($customersCount))->pagination();

        // 用户的性别，值为1时是男性，值为2时是女性，值为0时是未知
        $sex =  array('未知', '男', '女');

        $this->view('customer/index', array('customers' => $customers, 'pages' => $pages,
            'params' => RequestUtil::getParams(), 'limit' => $limit, 'sex' => $sex));
    }
}