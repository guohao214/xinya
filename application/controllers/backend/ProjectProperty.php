<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 2016/3/22
 * Time: 23:37
 */
class ProjectProperty extends BackendController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ProjectPropertyModel', 'projectPropertyModel');
    }

    public function projectForNewUserList()
    {
        $projects = $this->projectPropertyModel->getForNewUserProjectList();
        $categories = (new CategoryModel())->getAllCategories();
        $this->view('projectProperty/forNewUserList', array('projects' => $projects, 'categories' => $categories));
    }

    /**
     * 增加新用户专享
     */
    public function addForNewUserProject()
    {
        if (RequestUtil::isPost()) {
            $params = RequestUtil::postParams();

            $insertId = (new CurdUtil($this->projectPropertyModel))->create($params);

            if ($insertId)
                $this->message('新增成功!', 'ProjectProperty/projectForNewUserList');
            else
                $this->message('新增失败!');
        }

        $categories = (new CategoryModel())->getAllCategories();
        $this->view('projectProperty/forNewUser', array('categories' => $categories));
    }

    /**
     * 增加新用户专享
     */
    public function deleteForNewUserProject($projectPropertyId)
    {
        $returnBack = 'ProjectProperty/projectForNewUserList';

        if ((new CurdUtil($this->projectPropertyModel))
            ->update(array('project_property_id' => $projectPropertyId), array('disabled' => 1))
        )
            $this->message('删除成功！', $returnBack);
        else
            $this->message('删除失败！', $returnBack);
    }
}