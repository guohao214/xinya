<?php

class ShopModel extends BaseModel
{

    public function setTable()
    {
        $this->table = 'shop';
    }

    public function getAllShops()
    {
        $shops = (new CurdUtil($this))->readAll('create_time desc', array('disabled' => 0));
        $_shops = array();

        foreach($shops as $shop) {
            $_shops[$shop['shop_id']] = $shop['shop_name'];
        }

        return $_shops;
    }

    public function rules()
    {
        // 添加验证
        $validate = new ValidateUtil();

        $validate->required('shop_name');
        $validate->required('address');

        $validate->minLength('shop_name', 1);
        $validate->maxLength('shop_name', 100);

        $validate->minLength('address', 1);
        $validate->maxLength('address', 100);

        $validate->minLength('contacts', 1);
        $validate->maxLength('contacts', 50);

        $validate->minLength('contact_number', 1);
        $validate->maxLength('contact_number', 32);



        return $validate;
    }
} 