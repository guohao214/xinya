<?php

class ArticleModel extends BaseModel
{

    public function setTable()
    {
        $this->table = 'article';
    }


    public function rules()
    {
        // 添加验证
        $validate = new ValidateUtil();

        $validate->required('content');
        $validate->required('alias_name');
        $validate->required('title');

        $validate->minLength('alias_name', 1);
        $validate->maxLength('alias_name', 100);

        $validate->minLength('title', 1);
        $validate->maxLength('title', 100);

        return $validate;
    }
} 