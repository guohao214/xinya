<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 2016/2/27
 * Time: 0:45
 */
class CustomerCouponModel extends BaseModel
{
    public function setTable()
    {
        $this->table = 'customer_coupon';
    }

    public function create($data)
    {
        return (new CurdUtil($this))->create($data);
    }

    public function readOneById($customerCouponId)
    {
        $coupon = new CouponModel();

        $where = array('customer_coupon_id' => $customerCouponId);
        $this->db->order_by('customer_coupon_id desc');
        $this->db->limit(1, 0);
        $this->db->where($where);
        $this->db->join($coupon->table, "{$this->table}.coupon_id={$coupon->table}.coupon_id");
        $query = $this->db->get($this->table);

        return array_shift($query->result_array());
    }

    /**
     * 获得当前用户领取的优惠券
     * @param $openId
     * @param int $offset
     */
    public function getCustomerCouponList($openId, $offset = 0)
    {
        $coupon = new CouponModel();

        $where = array('open_id' => $openId);
        $this->db->order_by('customer_coupon_id desc');

        $pagination = ConfigUtil::loadConfig('pagination');
        $limit = $pagination['per_page'];

        $this->db->join($coupon->table, "{$this->table}.coupon_id={$coupon->table}.coupon_id");
        $query = $this->db->get_where($this->table, $where, $limit, $offset);

        return $query->result_array();
    }

    /**
     * 获得用户未使用的，已到使用时间， 未过期 的优惠券
     * @param $openId
     */
    public function getCustomerNotUseCouponList($openId)
    {
        $coupon = new CouponModel();

        $day = date('Y-m-d');
        $where = array('open_id' => $openId, 'is_use' => 0, 'start_time<=' => $day, 'expire_time >=' => $day);
        $this->db->order_by('customer_coupon_id desc');
        $this->db->where($where);
        $this->db->join($coupon->table, "{$this->table}.coupon_id={$coupon->table}.coupon_id");
        $query = $this->db->get($this->table);

        return $query->result_array();
    }

    /**
     * 获得优惠码总数
     * @param $openId
     * @return mixed
     */
    public function getCustomerCouponCount($openId)
    {
        $coupon = new CouponModel();

        $where = array('open_id' => $openId);

        $this->db->where($where);
        $this->db->join($coupon->table, "{$this->table}.coupon_id={$coupon->table}.coupon_id");
        return $this->db->count_all_results($this->table);
    }

    /**
     * 设置使用优惠券
     * @param $customerCouponId
     * @param $openId
     * @return bool
     */
    public function useCoupon($customerCouponId, $openId)
    {
        return (new CurdUtil($this))->update(
            array('customer_coupon_id' => $customerCouponId, 'open_id' => $openId), array('is_use' => 1));
    }

    /**
     * 退回优惠券
     * @param $customerCouponId
     * @param $openId
     * @return bool
     */
    public function refundCoupon($customerCouponId, $openId) {
        return (new CurdUtil($this))->update(
            array('customer_coupon_id' => $customerCouponId, 'open_id' => $openId), array('is_use' => 0));
    }

    public function readOne($couponId, $openId)
    {
        return (new CurdUtil($this))->readOne(array('coupon_id' => $couponId, 'open_id' => $openId));
    }
}