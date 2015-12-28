<?php

class OrderModel extends BaseModel
{
    const ORDER_NOT_PAY = 1; //未支付
    const ORDER_PAYED = 2; // 已支付
    const ORDER_CONSUMED = 3; //已消费
    const ORDER_RETURNED = 4; //已退款

    public function setTable()
    {
        $this->table = 'order';
    }

    private function forQueryOrders()
    {
        $this->db->from($this->table);
        $orderProject = (new OrderProjectModel())->table;
        $this->db->select("{$this->table}.*, {$orderProject}.*");
        $this->db->select("{$this->table}.order_status+0 as order_sign", false);
        $this->db->join($orderProject, "{$this->table}.order_id={$orderProject}.order_id");
        $this->db->where("{$this->table}.disabled=0");
        $this->db->order_by("{$this->table}.order_id desc");
    }

    /**
     * 获取未支付的订单
     * @param $orderNo
     */
    public function getNotPayOrders($where)
    {
        $this->db->where("{$this->table}.order_status=" . self::ORDER_NOT_PAY);

        return $this->getOrders($where);
    }

    /**
     * 获得订单
     * @param $where
     * @param string $offset
     * @param int $rows
     * @return mixed
     */
    public function getOrders($where, $offset = 0, $rows = 10)
    {
        $this->forQueryOrders();
        $this->db->where($where);
        $this->db->limit($rows, $offset);

        $sql = $this->db->get_compiled_select();
        return (new CurdUtil($this))->query($sql);
    }

    public function getOrderCounts($where)
    {
        $this->forQueryOrders();
        $this->db->where($where);
        return $this->db->count_all_results();
    }

    /**
     * 上面的方法有问题，此处用sql语句
     * 我的订单
     */
    public function userOrders($openId, $orderStatus = 0, $offset = 0)
    {
        $paginationConfig = ConfigUtil::loadConfig('pagination');
        $rows = $paginationConfig['per_page'];

        $sql = "select a.*, b.*, a.order_status+0 as order_sign from `order` as a right
                join (select distinct(order_no) from `order` limit {$offset}, {$rows}) as c on a.order_no=c.order_no
                left join order_project as b on a.order_id=b.order_id where a.disabled=0 and a.open_id='{$openId}'";

        if ($orderStatus)
            $sql .= ' and a.order_status=' . $orderStatus;
        return (new CurdUtil($this))->query($sql);
    }

    public function userOrderCounts($openId, $orderStatus = 0)
    {
        $sql = "select count(distinct(a.order_no)) as `rowCounts` from `order` as a right
                join (select distinct(order_no) from `order`) as c on a.order_no=c.order_no
                left join order_project as b on a.order_id=b.order_id where a.disabled=0 and a.open_id='{$openId}'";

        if ($orderStatus)
            $sql .= ' and a.order_status=' . $orderStatus;
        return (new CurdUtil($this))->query($sql);
    }

} 