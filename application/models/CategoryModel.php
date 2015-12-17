<?php

class CategoryModel extends BaseModel
{

    public function setTable()
    {
        $this->table = 'category';
    }


   	public function readAll()
    {
    	$projectModel = new ProjectModel();
    	
    	$this->db->from($this->table);
    	$this->db->order_by("{$this->table}.create_time desc");

		$join = "{$this->table}.category_id={$projectModel->table}.category_id";
		$where = "{$this->table}.category_id=0 and {$projectModel->table}.category1_id=0";
		$this->db->where($where);
		$this->db->join($projectModel->table, $join);
		$this->db->group_by('category_id');

    	$query = $this->db->get();
    	return $query->result_array();
    }
} 