<?php

/**
 * 预约项目
 * User: GuoHao
 * Date: 2015/12/27
 * Time: 0:31
 */
class Project extends FrontendController
{
    /**
     * @param string $shopId 店铺ID
     */
    public function index($shopId = '')
    {
        if ($shopId)
            $shopId = $shopId + 0;

        $sliderModel = new SliderModel();
        $hdpSliders = $sliderModel->getAllSlider(SliderModel::SLIDER_TYPE_HDP);
        $fllSliders = $sliderModel->getAllSlider(SliderModel::SLIDER_TYPE_FLL);

        $_GET['page'] = 1;
        $renderProject = $this->getProjects(true);

        $this->outputCache();

        $this->view('project/index', array('shopId' => $shopId, 'hdpSliders' => $hdpSliders,
            'fllSliders' => $fllSliders, 'renderProject' => $renderProject));
    }

    /**
     * 获得产品列表
     */
    public function getProjects($return = false)
    {
        $params = RequestUtil::getParams();
        $page = $params['page'] + 0;

        $pagination = ConfigUtil::loadConfig('ajax_pagination');
        $offset = $pagination['per_page'] * $page;

        $projects = (new CurdUtil(new ProjectModel()))
                        ->readLimit(array('disabled' => 0), $offset, 'project_id desc', 'ajax_pagination');

        if ($return)
        return $this->load->view('frontend/project/_list.php',
            array('projects' => $projects, 'page' => $page, 'shopId' => 0), $return);
        else
            $this->load->view('frontend/project/_list.php',
                array('projects' => $projects, 'page' => $page, 'shopId' => 0));
    }


    public function projectList($categoryId)
    {
        $categoryId += 0;
        $categories = (new CategoryModel())->getAllCategories();
        $categoryName = $categories[$categoryId];
        $projects = (new ProjectModel())->getProjectsByCategoryId($categoryId);
        $this->view('project/projectList',
            array('projects' => $projects, 'categoryName' => $categoryName));
    }

    public function detail($projectId, $shopId = '')
    {
        if ($shopId)
            $shopId += 0;

        if (!$projectId)
            $this->message('项目ID不能为空！');

        $projectId += 0;

        $project = (new ProjectModel())->readOne($projectId);
        if (!$project)
            $this->message('获取项目详情失败，请重试！');

        $this->outputCache();

        $mainProjectId = $this->input->get('mpId') + 0;

        $mainProject = array();

        if (!$mainProjectId)
            $mainProjectId = $projectId;

        $mainProject = (new ProjectModel())->readOne($mainProjectId);
        $mainProject['relation_project_id'] = $mainProject['main_project_id'] = $mainProject['project_id'];

        // 获得不在首页的关联的项目
        $relationProjects = (new ProjectRelationModel())->getAllRelationProjects($mainProjectId);
        array_unshift($relationProjects, $mainProject);
        $this->load->view('frontend/project/detail',
            array('project' => $project, 'shopId' => $shopId, 'relationProjects' => $relationProjects));
    }
}