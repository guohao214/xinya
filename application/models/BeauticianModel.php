<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 2016/1/10
 * Time: 14:32
 */
class BeauticianModel extends BaseModel
{
    const ALL_DAY = 1;
    const MORNING_SHIFT = 2; // 早班
    const NIGHT_SHIFT = 3;   // 晚班
    const MIDDAY_SHIFT = 4;   // 中班
    const REST_SHIFT = 5;   // 休息

    public function setTable()
    {
        $this->table = 'beautician';
    }

    /**
     * 获得所有的美容师
     * @param $where
     */
    public function getAllBeauticians($where = array())
    {
        if (is_array($where))
            $where = array_merge($where, array('disabled' => 0));

        return (new CurdUtil($this))->readAll('beautician_id desc', $where);
    }

    public function getAllFormatBeauticians()
    {
        $beauticians = $this->getAllBeauticians();
        $_beauticians = array();
        foreach($beauticians as $beautician) {
            $_beauticians[$beautician['beautician_id']] = $beautician['name'];
        }

        unset($beauticians, $beautician);
        return $_beauticians;
    }

    public function rules()
    {
        $validate = new ValidateUtil();
        $validate->required('name');
        $validate->required('join_date');
        $validate->required('shop_id');

        $validate->numeric('shop_id');

        return $validate;
    }

    public function readOne($beauticianId)
    {
        return (new CurdUtil($this))->readOne(array('beautician_id' => $beauticianId, 'disabled' => 0));
    }

    /**
     * 检查是否为有效的美容师
     * @param $beauticianId
     * @return bool
     */
    public function isValidBeautician($beauticianId)
    {
        return ($this->readOne($beauticianId)) ? true : false;
    }
}