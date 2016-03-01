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

    public function create($data)
    {
        return (new CurdUtil($this))->create($data);
    }

    public function setIsGet($customerExchangeGoodsId, $openId)
    {
        return (new CurdUtil($this))->update(
            array('customer_exchange_goods_id' => $customerExchangeGoodsId, 'open_id' => $openId),
            array('is_get' => 1, 'get_time' => DateUtil::now()));
    }

    public function readOne($exchangeGoodsId, $openId)
    {
        return (new CurdUtil($this))->readOne(array('exchange_goods_id' => $exchangeGoodsId, 'open_id' => $openId));
    }

    public function getCustomerExchangeGoodsList($openId, $offset = 0)
    {
        $exchangeGoods = new ExchangeGoodsModel();

        $where = array('open_id' => $openId);
        $this->db->order_by('customer_exchange_goods_id desc');

        $pagination = ConfigUtil::loadConfig('pagination');
        $limit = $pagination['per_page'];

        $this->db->join($exchangeGoods->table, "{$this->table}.exchange_goods_id={$exchangeGoods->table}.exchange_goods_id");
        $query = $this->db->get_where($this->table, $where, $limit, $offset);

        return $query->result_array();
    }

    public function getCustomerExchangeGoodsCount($openId)
    {
        $exchangeGoods = new ExchangeGoodsModel();

        $where = array('open_id' => $openId);

        $this->db->where($where);
        $this->db->join($exchangeGoods->table, "{$this->table}.exchange_goods_id={$exchangeGoods->table}.exchange_goods_id");
        return $this->db->count_all_results($this->table);
    }
}