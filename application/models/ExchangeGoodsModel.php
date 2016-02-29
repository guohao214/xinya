<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 2016/2/29
 * Time: 21:37
 */
class ExchangeGoodsModel extends BaseModel
{
    public function setTable()
    {
        $this->table = 'exchange_goods';
    }

    public function subExchangeGoodsNumber($exchangeGoodsId)
    {
        $this->db->set('remain_number', "remain_number-1", FALSE);
        $this->db->where(array('exchange_goods_id' => $exchangeGoodsId));
        $this->db->update($this->table);
        return $this->db->affected_rows();
    }

    public function rules()
    {
        // 添加验证
        $validate = new ValidateUtil();

        $validate->required('exchange_goods_name');
        $validate->required('exchange_credits');
        $validate->required('total_number');
        $validate->required('expire_time');
        $validate->required('start_time');

        return $validate;
    }

    public function getAllExchangeGoods()
    {
        $this->db->where('expire_time >=', date('Y-m-d'));
        return  (new CurdUtil($this))->readAll('exchange_goods_id desc', array('disabled' => 0));
    }

    public function readOne($exchangeGoodsId)
    {
        return (new CurdUtil($this))->readOne(array('exchange_goods_id' => $exchangeGoodsId, 'disabled' => 0));
    }
}