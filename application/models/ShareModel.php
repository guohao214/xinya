<?php

class ShareModel extends BaseModel
{
    public function setTable()
    {
        $this->table = 'mk_share';
    }

    public function create($firstOpenId, $secondOpenId, $buyerOpenId)
    {
        $data = array(
            'first_stage_open_id' => $firstOpenId,
            'second_stage_open_id' => $secondOpenId,
            'buyer_open_id' => $buyerOpenId,
            'create_time' => DateUtil::now()
        );

        return (new CurdUtil($this))->create($data);
    }

    public function readOne($firstOpenId, $secondOpenId, $buyerOpenId)
    {
        $data = array(
            'first_stage_open_id' => $firstOpenId,
            'second_stage_open_id' => $secondOpenId,
            'buyer_open_id' => $buyerOpenId
        );

        return (new CurdUtil($this))->readOne($data);
    }

    public function readOneByShareId($shareId)
    {
        return (new CurdUtil($this))->readOne(array('mk_share_id' => $shareId));
    }

}