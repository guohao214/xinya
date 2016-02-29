<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 2016/2/29
 * Time: 22:21
 */
class CustomerExchangeGoodsModel extends BaseModel
{
    public function setTable()
    {
        $this->table = 'customer_exchange_goods';
    }

    public function setIsGet($customerExchangeGoodsId, $openId)
    {
        return (new CurdUtil($this))->update(
            array('customer_exchange_goods_id' => $customerExchangeGoodsId, 'open_id' => $openId),
            array('is_get' => 1, 'get_time' => DateUtil::now()));
    }
}