<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 2017/4/4
 * Time: 18:44
 */
class WithdrawDepositAccountModel extends BaseModel
{
    public function setTable()
    {
        $this->table = 'mk_withdraw_deposit_account';
    }

    public function getList($openId)
    {
        return (new CurdUtil($this))->readAll('mk_dpa_id desc',
            array('open_id' => $openId, 'disabled' => 0));
    }

    public function readOne($openId, $dpaId) {
        return (new CurdUtil($this))->readOne(array('open_id' => $openId, 'mk_dpa_id' => $dpaId));
    }
}