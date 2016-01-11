<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 2016/1/10
 * Time: 14:32
 */
class BeauticianRestModel extends BaseModel
{
    public function setTable()
    {
        $this->table = 'beautician_rest';
    }

    public function rules()
    {
        $validate = new ValidateUtil();
        $validate->required('rest_day');
        $validate->required('start_time');
        $validate->required('end_time');
        $validate->required('ps');
        $validate->required('beautician_id');

        return $validate;
    }
}