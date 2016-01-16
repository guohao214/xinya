<?php

class CategoryModel extends BaseModel
{
    private $cacheName = 'categories';

    public function setTable()
    {
        $this->table = 'category';
    }

    public function deleteCacheCategories()
    {
        $this->deleteCache($this->cacheName);
    }


    public function getAllCategoriesWithProjectCounts()
    {
        $project = new ProjectModel();

        $sql = "SELECT *,(select count(*) from {$project->table} where
			{$project->table}.category_id={$this->table}.category_id and {$project->table}.disabled=0) as projects 
    	 FROM `{$this->table}` where {$this->table}.disabled=0 order by order_sort desc, create_time desc";


        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getAllCategories()
    {
        $_categories = $this->getCache($this->cacheName);
        if (!$_categories) {
            $categories = (new CurdUtil($this))->readAll('order_sort desc, create_time desc', array('disabled' => 0));
            $_categories = array();

            foreach ($categories as $category) {
                $_categories[$category['category_id']] = $category['category_name'];
            }

            $this->setCache($this->cacheName, $_categories);
        }

        return $_categories;
    }

    public function rules()
    {
        // 添加验证
        $validate = new ValidateUtil();
        $validate->required('category_name');
        $validate->minLength('category_name', 1);
        $validate->maxLength('category_name', 100);

        $validate->required('order_sort');
        $validate->numeric('order_sort');

        return $validate;
    }
} 