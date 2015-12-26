<?php
/**
 * Created by PhpStorm.
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
        $projects = (new ProjectModel())->allProjectsGroupByCategoryId($shopId);
        $shops = (new ShopModel())->getAllShops();
        $categories = (new CategoryModel())->readAllAssoc();

        $this->view('project/index', array('shops' => $shops, 'projects' => $projects,
            'categories' => $categories, 'shopId' => $shopId));
    }

    public function detail($projectId)
    {
        if (!$projectId)
            $this->message('项目ID不能为空！');

        $projectId += 0;

        $project = (new ProjectModel())->readOne($projectId);
        if (!$project)
            $this->message('获取项目详情失败，请重试！');

        $this->load->view('frontend/project/detail', array('project' => $project));
    }
}