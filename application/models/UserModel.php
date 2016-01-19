<?php

class UserModel extends BaseModel
{
    const ADMIN = 1; //管理员
    const SHOP_KEEPER = 2; // 店长

    public function setTable()
    {
        $this->table = 'user';
    }


    public function rules($onlyPassword = false)
    {
        // 添加验证
        $validate = new ValidateUtil();

        if (!$onlyPassword) {
            $validate->required('user_name');
            $validate->minLength('user_name', 1);
            $validate->maxLength('user_name', 50);
        }

        $validate->required('password');
        $validate->required('re_password');

        $validate->minLength('password', 6);
        $validate->maxLength('password', 32);

        $validate->matches('password', 're_password');

        return $validate;
    }

    public function encodePassword($password)
    {
        return md5($password . '_xinya888');
    }
} 