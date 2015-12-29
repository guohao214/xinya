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

    /**
     * @param $where
     * @return mixed
     */
    public function getOrder($where = array(), $orderStatus = 0)
    {
        $this->db->from($this->table);
        $orderProject = (new OrderProjectModel())->table;
        $this->db->select("{$this->table}.*, {$orderProject}.*");
        $this->db->join($orderProject, "{$this->table}.order_id={$orderProject}.order_id");
        $this->db->where("{$this->table}.disabled=0");
        $this->db->order_by("{$this->table}.order_id desc");

        if ($where)
            $this->db->where($where);

        if ($orderStatus)
            $this->db->where("{$this->table}.order_status=" . $orderStatus);

        $sql = $this->db->get_compiled_select();
        return (new CurdUtil($this))->query($sql);
    }


    /**
     * 上面的方法有问题，此处用sql语句
     * 我的订单
     * @param $openId
     * @param int $orderStatus
     * @param int $offset
     * @return mixed
     */
    public function userOrders($openId, $orderStatus = 0, $offset = 0)
    {
        $paginationConfig = ConfigUtil::loadConfig('pagination');
        $rows = $paginationConfig['per_page'];

        $sql = "select a.*, b.*, a.order_status+0 as order_sign from `order` as a right
                join (select distinct(order_no) from `order` where `order`.open_id='{$openId}'";


        if ($orderStatus)
            $sql .= " and `order`.order_status={$orderStatus}";

        $sql .= " and `order`.disabled=0 limit {$offset}, {$rows} ) as c on a.order_no=c.order_no
                left join order_project as b on a.order_id=b.order_id";

        return (new CurdUtil($this))->query($sql);
    }

    /**
     * 计算我的订单总数
     * @param $openId
     * @param int $orderStatus
     * @return mixed
     */
    public function userOrderCounts($openId, $orderStatus = 0)
    {
        $sql = "select (count(distinct(order_no))) from `order` where open_id='{$openId}'";

        if ($orderStatus)
            $sql .= ' and `order`.order_status=' . $orderStatus;

        $sql .= ' and `order`.disabled=0';

        return (new CurdUtil($this))->query($sql);
    }

} 