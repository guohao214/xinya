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
     * 获取未支付的订单
     * @param $orderNo
     */
    public function getNotPayOrders($where)
    {
        $this->db->from($this->table);
        $this->db->where($where);
        $orderProject = (new OrderProjectModel())->table;
        $this->db->join($orderProject, "{$this->table}.order_id={$orderProject}.order_id");
        $this->db->where("{$this->table}.disabled=0");
        $this->db->where("{$this->table}.order_status=" . self::ORDER_NOT_PAY);

        $sql = $this->db->get_compiled_select();
        return (new CurdUtil($this))->query($sql);
    }

} 