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

    public function orders($where = array())
    {
        $this->db->select('*');
        $this->db->select('order_status+0 as order_sign', false);
        $this->db->from($this->table);
        $this->db->where($where);

        $query = $this->db->get();

        return $query->result_array();
    }

    /**
     * 设置订单为已支付
     * @param $orderNo
     * @param $openId
     * @param $wxOrderNo 微信订单号
     */
    public function payed($orderNo, $wxOrderNo)
    {
        $where = array('order_no' => $orderNo);

        $updateData = array(
            'pay_time' => DateUtil::now(),
            'order_status' => self::ORDER_PAYED,
            'transaction_id' => $wxOrderNo,
        );

        $this->db->where($where);
        $this->db->update($this->table, $updateData);

        return $this->db->affected_rows();
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
        $paginationConfig = ConfigUtil::loadConfig('user-center');
        $rows = $paginationConfig['per_page'];

        $sql = "select a.*, b.*, a.order_status+0 as order_sign from `order` as a right
                join (select distinct(order_no) from `order` where `order`.open_id='{$openId}'";


        if ($orderStatus)
            $sql .= " and `order`.order_status={$orderStatus}";

        $sql .= " and `order`.disabled=0 order by order.order_id desc limit {$offset}, {$rows}) as c on a.order_no=c.order_no
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
        $sql = "select (count(distinct(order_no))) as rowCounts from `order` where open_id='{$openId}'";

        if ($orderStatus)
            $sql .= ' and `order`.order_status=' . $orderStatus;

        $sql .= ' and `order`.disabled=0';

        return (new CurdUtil($this))->query($sql);
    }

} 