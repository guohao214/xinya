<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 2016/1/10
 * Time: 14:32
 */
class BeauticianModel extends BaseModel
{
    public function setTable()
    {
        $this->table = 'beautician';
    }

    /**
     * 获得所有的美容师
     */
    public function getAllBeauticians()
    {
        $where = array('disabled' => 0);
         return (new CurdUtil($this))->readAll('beautician_id desc', $where);
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

    public function readOne($beautician_id)
    {
        return (new CurdUtil($this))->readOne(array('beautician_id' => $beautician_id, 'disabled' => 0));
    }
}