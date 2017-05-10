<?php

class MakerModel extends BaseModel
{
    public function setTable()   {
        $this->table = 'maker';
    }

    /**
     * 判断创客是否存在
     * @param $openId
     * @return bool
     */
    public function isExists($openId)
    {
        $maker = (new CurdUtil($this))->one(array('open_id' => $openId, 'disabled' => 0, 'status' => 1), 'maker_id desc');
        return $maker ? true : false;
    }

    public function readOne($openId)
    {
        return (new CurdUtil($this))->one(array('open_id' => $openId, 'disabled' => 0), 'maker_id desc');
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data) {
        $data['apply_time'] = DateUtil::now();

        return (new CurdUtil($this))->create($data);
    }

    /**
     * 汇总
     *
     * @param $id
     * @param $status
     * @return array
     */
    public function verify($id, $status)
    {
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
    }

    /**
     * @param int $offset
     * @return array
     */
    public function getList($offset = 0)
    {
        $limit = 10;

        $sql = "select SQL_CALC_FOUND_ROWS a.*,b.nick_name, b.avatar 
                  from maker as a 
                  left join customer as b 
                  on a.open_id = b.open_id 
                  where a.disabled=0 limit {$offset}, {$limit}";

        $rows = (new CurdUtil($this))->query($sql);
        $count = (new CurdUtil($this))->query("select FOUND_ROWS() as `c_count`");
        if ($count)
            $count = $count[0]['c_count'];
        else
            $count = 0;


        return array(
            'list' => $rows,
            'count' => $count
        );
    }
}