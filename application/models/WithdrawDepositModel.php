<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 2017/4/4
 * Time: 0:49
 */
class WithdrawDepositModel extends BaseModel
{
    public function setTable()
    {
        $this->table = 'mk_withdraw_deposit';
    }

    /**
     * 提现记录
     * @param $openId
     * @param int $offset
     * @return array
     */
    public function getList($openId, $offset = 0)
    {
        return (new CurdUtil($this))->readAll('mk_dp_id desc', array('open_id' => $openId));
    }

    public function create($data) {
        return (new CurdUtil($this))->create($data);
    }

    public function getListWithCustomer($offset = 0) {
        $customerTableName = (new CustomerModel())->table;

        $sql = "select SQL_CALC_FOUND_ROWS a.*, a.status+0 as _status, b.nick_name 
                  from {$this->table} as a left JOIN {$customerTableName} as b 
                  on a.open_id=b.open_id
                  limit {$offset}, 10";

        $rows = (new CurdUtil($this))->query($sql);
        $count = (new CurdUtil($this))->query("SELECT FOUND_ROWS() as count");

        return array('rows' => $rows, 'count' => $count[0]['count']);
    }
}