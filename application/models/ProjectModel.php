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
//        $validate->minLength('effects', 1);
//        $validate->maxLength('effects', 500);

        return $validate;
    }

    /**
     * @param array $where
     * @return mixed
     */
    public function allProjects($where = array())
    {
        if ($where) {
            $this->db->where($where);
        }

        $this->db->where(array('disabled' => 0));

        // 可以做缓存
        return (new CurdUtil($this))->readAll('project_id desc');
    }

    /**
     * 获得所有的项目
     * @param string $shopId
     * @return array
     */
    public function allProjectsGroupByCategoryId($shopId = '')
    {
        if ($shopId)
            $this->db->where_in('shop_id', array(0, $shopId));

        // 可以做缓存
        $projects = $this->allProjects();
        $_projects = array();
        foreach ($projects as $project) {
            $shopId = $project['category_id'];
            $_projects[$shopId][] = $project;
        }

        unset($project, $projects, $shopId);
        return $_projects;
    }

    public function readOne($projectId)
    {
        return (new CurdUtil($this))->
            readOne(array('project_id' => $projectId, 'disabled' => 0));
    }

    public function readByProjectIds($projectIds)
    {
        $this->db->where_in('project_id', $projectIds);

        return $this->allProjects();
    }

} 