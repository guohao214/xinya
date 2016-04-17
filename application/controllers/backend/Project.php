<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 15-12-14
 * Time: 下午10:52
 */
class Project extends BackendController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ProjectModel', 'projectModel');
        $this->projectModel->deleteProjectsCache();
    }

    public function readAllProjectByCategory($categoryId)
    {
        $projects = (new CurdUtil($this->projectModel))
            ->readAll('project_id desc', array('category_id' => $categoryId));

        $html = '';
        foreach ($projects as $project) {
            $html .= "<option value={$project['project_id']}>{$project['project_name']}</option>";
        }

        ResponseUtil::json($html);
    }


    public function index($limit = '')
    {
        $where = RequestUtil::buildLikeQueryParamsWithDisabled();

        $projects = (new CurdUtil($this->projectModel))->readLimit($where, $limit, 'project_id desc');
        $projectsCount = (new CurdUtil($this->projectModel))->count($where);
        $pages = (new PaginationUtil($projectsCount))->pagination();
        $categories = (new CategoryModel())->getAllCategories();
        $shops = (new ShopModel())->getAllShops();

        $categoryId = $this->input->get('category_id') + 0;

        $this->view('project/index', array('projects' => $projects, 'shops' => $shops, 'limit' => $limit + 0,
            'pages' => $pages, 'categories' => $categories, 'params' => RequestUtil::getParams(),
            'categoryId' => $categoryId));
    }

    public function deleteProject($project_id, $limit = 0)
    {
        if (!$project_id)
            $this->message('项目ID不能为空！');

        if ((new CurdUtil($this->projectModel))->update(array('project_id' => $project_id), array('disabled' => 1)))
            $this->message('删除项目成功！', "project/index/{$limit}");
        else
            $this->message('删除项目失败！', "project/index/{$limit}");
    }

    public function updateProject($project_id, $limit = 0)
    {
        if (RequestUtil::isPost()) {
            if ($this->projectModel->rules()->run()) {
                $params = RequestUtil::postParams();

                $mainProjectId = $params['main_project_id'] + 0;
                $resetMainProjectId = $params['reset_main_project_id'] + 0;

                unset($params['main_project_id'], $params['reset_main_project_id']);
                // 执行更新操作
                if (($mainProjectId != $resetMainProjectId) && $resetMainProjectId > 0) {
                    (new ProjectRelationModel())->updateRelation($project_id, $resetMainProjectId);
                }

                $upload = UploadUtil::commonUpload(array('upload/resize_200x200',
                    'upload/resize_600x600', 'upload/resize_100x100'));

                if ($upload)
                    $params['project_cover'] = $upload;

                $params['update_time'] = DateUtil::now();
                if ((new CurdUtil($this->projectModel))->update(array('project_id' => $project_id), $params))
                    $this->message('修改项目成功!', 'project/updateProject/' . $project_id . "/{$limit}");
                else
                    $this->message('修改项目失败!', 'project/updateProject/' . $project_id . "/{$limit}");
            }

        }

        $categories = (new CategoryModel())->getAllCategories();
        $shops = (new ShopModel())->getAllShops();
        $project = $this->projectModel->readOne($project_id);
        if (!$project)
            $this->message('项目不存在或者已被删除！', "project/index/{$limit}");

        // 获得关联信息
        $mainProject = $relationProject = array();
        $relationProject = (new ProjectRelationModel())->getMainRelationProject($project_id);
        if($relationProject['main_project_id']) {
            $mainProject =$this->projectModel->readOne($relationProject['main_project_id']);
        }

        $this->view('project/updateProject', array('categories' => $categories, 'project' => $project,
            'shops' => $shops, 'limit' => $limit, 'mainProject' => $mainProject, 'relationProject' => $relationProject));

    }

    public function addProject()
    {
        if (RequestUtil::isPost()) {
            if ($this->projectModel->rules()->run()) {
                $params = RequestUtil::postParams();
                $mainProjectId = $params['main_project_id'];
                unset($params['main_project_id']);

                $params['project_cover'] = UploadUtil::commonUpload(array('upload/resize_200x200',
                    'upload/resize_600x600', 'upload/resize_100x100'));

                $insertId = (new CurdUtil($this->projectModel))->
                create(array_merge($params, array('create_time' => DateUtil::now())));

                // 关联项目
                if ($mainProjectId) {
                   (new CurdUtil(new ProjectRelationModel()))->create(array('main_project_id' => $mainProjectId, 'relation_project_id' => $insertId));
                }

                if ($insertId)
                    $this->message('新增项目成功!', 'project/index');
                else
                    $this->message('新增项目失败!', 'project/index');
            }

        }

        $categories = (new CategoryModel())->getAllCategories();
        $shops = (new ShopModel())->getAllShops();
        $this->view('project/addProject', array('categories' => $categories, 'shops' => $shops));
    }
} 