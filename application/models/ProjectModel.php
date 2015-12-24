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

    public function allProjects()
    {
        // 可以做缓存
        return (new CurdUtil($this))->readAll('project_id desc', array('disabled' => 0));
    }

    /**
     * 获得所有的项目
     */
    public function allProjectsGroupByCategoryId()
    {
        // 可以做缓存
        $projects =  $this->allProjects();
        $_projects = array();
        foreach($projects as $project)
        {
            $shopId = $project['category_id'];
            $_projects[$shopId][] = $project;
        }

        unset($project, $projects, $shopId);
        return $_projects;
    }
 
} 