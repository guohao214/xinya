<?php

class ProjectModel extends BaseModel
{

    public function setTable()
    {
        $this->table = 'project';
    }

    public function rules()
    {
        // 添加验证
        $validate = new ValidateUtil();

        $validate->required('project_name');
        $validate->required('category_id');
        $validate->numeric('category_id');

        $validate->required('use_time');
        $validate->numeric('use_time');

        $validate->required('price');
        $validate->numeric('price');

        $validate->required('suitable_skin');
        $validate->minLength('suitable_skin', 1);
        $validate->maxLength('suitable_skin', 500);

        $validate->required('effects');
        $validate->minLength('effects', 1);
        $validate->maxLength('effects', 500);

        return $validate;
    }
 
} 