<?php

class CouponModel extends BaseModel
{

    public function setTable()
    {
        $this->table = 'coupon';
    }

    /**
     * 获得所有有效的优惠券
     */
    public function getAllCoupons()
    {
        $this->db->where('expire_time >=', date('Y-m-d'));
        return  (new CurdUtil($this))->readAll('coupon_id desc', array('disabled' => 0));
    }


    public function rules()
    {
        // 添加验证
        $validate = new ValidateUtil();

        $validate->required('coupon_name');
        $validate->required('exchange_credits');
        $validate->required('counteract_amount');
        $validate->required('use_rule');
        $validate->required('total_number');
        $validate->required('expire_time');
        $validate->required('start_time');

        return $validate;
    }

    public function readOne($couponId)
    {
        return (new CurdUtil($this))->readOne(array('coupon_id' => $couponId, 'disabled' => 0));
    }

    /**
     * 兑换优惠券
     * @param $couponId
     * @param $openId
     * @return bool
     */
    public function exchangeCoupon($couponId, $openId)
    {
        $customerModel = new CustomerModel();
        $customer = $customerModel->readOne($openId);
        // 获得积分
        if (!$customer)
            return false;

        $coupon = $this->readOne($couponId);
        if (!$couponId)
            return false;

        if ($coupon['remain_number'] <= 0)
            return false;

        // 用户的积分 >= 所需要的积分
        if ($customer['credits'] >= $coupon['exchange_credits']) {
            $customerModel->subCredits($openId, $coupon['exchange_credits']);
            $this->subCouponNumber($couponId);
        } else {
            return false;
        }
    }

    public function subCouponNumber($couponId)
    {
        $this->db->set('remain_number', "remain_number-1", FALSE);
        $this->db->where(array('coupon_id' => $couponId));
        $this->db->update($this->table);
        return $this->db->affected_rows();
    }
} 