<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 2016/2/27
 * Time: 18:10
 */
class CouponCodeModel extends BaseModel
{
    public function setTable()
    {
        $this->table = 'coupon_code';
    }

    public function rules()
    {
        // 添加验证
        $validate = new ValidateUtil();

        $validate->required('coupon_code');
        $validate->required('discount');
        $validate->required('use_rule');
        $validate->required('expire_time');
        $validate->required('start_time');

        return $validate;
    }

    /**
     * 优惠码增加使用次数
     * @param $couponCode
     * @return mixed
     */
    public function addUseTimes($couponCode)
    {
        $this->db->set('use_times', "use_times+1", FALSE);
        $this->db->where(array('coupon_code' => $couponCode));
        $this->db->update($this->table);
        return $this->db->affected_rows();
    }

    /**
     * 读取一条
     * @param $couponCodeId
     * @return mixed
     */
    public function readOne($couponCodeId)
    {
        return (new CurdUtil($this))->readOne(array('coupon_code_id' => $couponCodeId, 'disabled' => 0));
    }

    public function readOneByCode($couponCode)
    {
        return (new CurdUtil($this))->readOne(array('coupon_code' => $couponCode, 'disabled' => 0));
    }
}