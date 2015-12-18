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
} 