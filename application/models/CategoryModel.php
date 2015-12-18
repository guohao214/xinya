<?php

class CategoryModel extends BaseModel
{

    public function setTable()
    {
        $this->table = 'category';
    }


    public function readAll()
    {
        $project = new ProjectModel();

        $sql = "SELECT *,(select count(*) from {$project->table} where
			{$project->table}.category_id={$this->table}.category_id and {$project->table}.disabled=0) as projects 
    	 FROM `{$this->table}` where {$this->table}.disabled=0";


        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function rules()
    {
        // 添加验证
        $validate = new ValidateUtil();
        $validate->required('category_name');
        $validate->minLength('category_name', 1);
        $validate->maxLength('category_name', 100);

        return $validate;
    }
} 