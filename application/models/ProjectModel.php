<?php

class ProjectModel extends BaseModel
{
    public $cacheName = 'projects';
    public $formatCacheName = 'formatProjects';

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

        $validate->required('order_sort');
        $validate->numeric('order_sort');

//        $validate->required('suitable_skin');
//        $validate->minLength('suitable_skin', 1);
//        $validate->maxLength('suitable_skin', 500);

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
     * 获得所有的项目，并且按照
     */
    public function allProjectsBySql()
    {
        $projects = $this->getCache($this->cacheName);
        if (!$projects) {
            $sql = "select a.*, b.category_id, b.category_name from project as a left join "
                . "category as b on a.category_id=b.category_id where a.disabled=0 and b.disabled=0 "
                . "order by b.order_sort desc,a.order_sort desc;";

            $projects = (new CurdUtil(this))->query($sql);

            $this->setCache($this->cacheName, $projects);
        }

        return $projects;
    }

    public function deleteProjectsCache()
    {
        $this->deleteCache($this->cacheName);
        $this->deleteCache($this->formatCacheName);
    }

    /**
     * 获得所有的项目
     * @param string $shopId
     * @return array
     */
    public function allProjectsGroupByCategoryId()
    {
        // 可以做缓存
        $_projects = $this->getCache($this->formatCacheName);
        if (!$_projects) {
            $projects = $this->allProjectsBySql();
            foreach ($projects as $project) {
                $categoryId = $project['category_id'];
                $_projects[$categoryId][] = $project;
            }

            $this->setCache($this->formatCacheName, $_projects);
            unset($project, $projects, $shopId);
        }
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