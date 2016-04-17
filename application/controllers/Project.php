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

        // 此处需要做缓存
        $projects = (new ProjectModel())->allProjectsGroupByCategoryId();
        $shops = (new ShopModel())->getAllShops();
        $categories = (new CategoryModel())->getAllCategories();

        $sliderModel = new SliderModel();
        $hdpSliders = $sliderModel->getAllSlider(SliderModel::SLIDER_TYPE_HDP);
        $fllSliders = $sliderModel->getAllSlider(SliderModel::SLIDER_TYPE_FLL);

        $this->outputCache();

        $this->view('project/index', array('shops' => $shops, 'projects' => $projects,
            'categories' => $categories, 'shopId' => $shopId, 'hdpSliders' => $hdpSliders,
            'fllSliders' => $fllSliders));
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
        $mainProject['relation_project_id'] = $mainProject['main_project_id']  = $mainProject['project_id'];

        // 获得不在首页的关联的项目
        $relationProjects = (new ProjectRelationModel())->getAllRelationProjects($mainProjectId);
        array_unshift($relationProjects, $mainProject);
        $this->load->view('frontend/project/detail',
            array('project' => $project, 'shopId' => $shopId, 'relationProjects' => $relationProjects));
    }
}