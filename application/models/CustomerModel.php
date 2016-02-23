<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 2016/2/22
 * Time: 23:05
 */
class CustomerModel extends BaseModel
{
    public function setTable()
    {
        $this->table = 'customer';
    }

    /**
     * 增加积分
     * @param $openId
     * @param $score
     */
    public function addCredits($openId = '', $score = 0)
    {
        $this->db->set('credits', "credits+{$score}", FALSE);
        $this->db->where(array('open_id' => $openId));
        $this->db->update($this->table);
        return $this->db->affected_rows();
    }

    /**
     * 读取记录
     * @param $openId
     * @return mixed
     */
    public function readOne($openId)
    {
        return (new CurdUtil($this))->readOne(array('open_id' => $openId));
    }

    /**
     * 增加记录
     * @param $openId
     * @param int $credits
     * @return mixed
     */
    public function create($openId, $credits = 0)
    {
        return (new CurdUtil($this))->create(array('open_id' => $openId, 'credits' => $credits));
    }

    public function insert($openId, $credits = 0, $nickName, $avatar, $city, $province, $sex)
    {
        $data = array(
            'open_id' => $openId,
            'credits' => $credits,
            'nick_name' => $nickName,
            'avatar' => $avatar,
            'city' => $city,
            'province' => $province,
            'sex' => $sex,
            'update_time' => DateUtil::now()
        );

        return (new CurdUtil($this))->create($data);
    }

    public function update($openId, $nickName, $avatar, $city, $province, $sex) {
        $data = array(
            'nick_name' => $nickName,
            'avatar' => $avatar,
            'city' => $city,
            'province' => $province,
            'sex' => $sex,
            'update_time' => DateUtil::now()
        );

        return (new CurdUtil($this))->update(array('open_id' => $openId), $data);
    }
}