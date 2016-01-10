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
         return (new CurdUtil($this))->readAll();
    }
}