<?php

class MakerOrderModel extends BaseModel
{
    public function setTable()
    {
        $this->table = 'mk_order';
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data) {
        $data['order_status'] = 0;
        $data['create_time'] = DateUtil::now();

        return (new CurdUtil($this))->create($data);
    }

    /**
     * 汇总
     *
     * @param $openId
     * @return array
     */
    public function group($openId)
    {
        $sql = "select 
            count(distinct buyer_open_id) as all_buyer,
            sum(order_amount) as all_amount,
            sum(order_amount*order_earnings_percent) as all_earnings_percent 
            from mk_order 
            where mk_open_id='{$openId}' 
            and order_status=1 
            group by mk_open_id;";

        $groupData = (new CurdUtil($this))->query($sql);

        return $groupData;
    }

    /**
     * 会员数
     *
     * @param $openId
     * @param int $offset
     * @return array
     */
    public function getCustomers($openId, $offset = 0)
    {
        $paginationConfig = ConfigUtil::loadConfig('user_center');
        $rows = $paginationConfig['per_page'];
        $curd = new CurdUtil($this);

        $sql = "select * 
                from 
                (
                    select 
                    distinct buyer_open_id,
                    count(order_no) as count_order_id 
                    from mk_order 
                    where mk_open_id='{$openId}' 
                    and order_status=1 
                    group by buyer_open_id limit {$offset},{$rows}
                ) as group_info 
                left join customer 
                on buyer_open_id=customer.open_id;";
        $customers = $curd->query($sql);

        $countSql = "select 
                    count(distinct buyer_open_id) as count_buyer 
                    from mk_order 
                    where mk_open_id='{$openId}' and order_status=1;";

        $count = $curd->query($countSql);
        if (!$count)
            $count = 0;
        else
            $count = array_shift($count);

        return array('customers' => $customers, 'count' => $count['count_buyer']);
    }

    /**
     * 收入汇总
     *
     * @param $openId
     * @param int $offset
     * @return array
     */
    public function getEarning($openId, $offset = 0)
    {
        $paginationConfig = ConfigUtil::loadConfig('user_center');
        $rows = $paginationConfig['per_page'];
        $curd = new CurdUtil($this);

        $sql = "select * 
                from 
                (
                    select 
                    distinct buyer_open_id, 
                    sum(order_amount) as all_amount,
                    sum(order_amount*order_earnings_percent) as all_earnings_percent
                    from mk_order 
                    where mk_open_id='{$openId}' 
                    and order_status=1 
                    group by buyer_open_id limit {$offset},{$rows}
                ) as group_info 
                left join customer 
                on buyer_open_id=customer.open_id;";
        $customers = $curd->query($sql);

        $countSql = "select 
                    count(distinct buyer_open_id) as count_buyer 
                    from mk_order 
                    where mk_open_id='{$openId}' and order_status=1;";

        $count = $curd->query($countSql);
        if (!$count)
            $count = 0;
        else
            $count = array_shift($count);

        return array('customers' => $customers, 'count' => $count['count_buyer']);
    }

    /**
     * 获得提现金额
     *
     * @param $openId
     * @return number
     */
    public function getWithdrawDepositAmount($openId)
    {
        $sql = "select 
                sum(order_amount*order_earnings_percent) as all_earnings_percent
                from mk_order 
                where mk_open_id='{$openId}' and withdraw_deposit_id = 0 and order_status=1";

        $curd = new CurdUtil($this);
        $amount = $curd->query($sql);
        if ($amount && is_array($amount) && $amount[0]['all_earnings_percent'] > 0)
            return $amount[0]['all_earnings_percent'];
        else
            return 0;
    }

    /**
     * 更新提现记录ID
     * @param $openId
     * @param $dpId
     *
     * @return number
     */
    public function setWithdrawDepositId($openId, $dpId)
    {
        return (new CurdUtil($this))->update(
            array('mk_open_id' => $openId, 'withdraw_deposit_id' => 0),
            array('withdraw_deposit_id' => $dpId)
        );
    }

    /**
     * @param $orderNo
     * @return bool
     */
    public function setOrderPayed($orderNo)
    {
        return (new CurdUtil($this))->update(
            array('order_no' => $orderNo),
            array('order_status' => 1)
        );
    }
}