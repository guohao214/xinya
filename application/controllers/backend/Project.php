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
    }


    public function index($limit = '')
    {
        $where = RequestUtil::buildLikeQueryParamsWithDisabled();

        $projects = (new CurdUtil($this->projectModel))->readLimit($where, $limit, 'project_id desc');
        $projectsCount = (new CurdUtil($this->projectModel))->count($where);
        $pages = (new PaginationUtil($projectsCount))->pagination();
        $categories = (new CategoryModel())->getAllCategories();
        $shops = (new ShopModel())->getAllShops();

        $this->view('project/index', array('projects' => $projects, 'shops' => $shops,
            'pages' => $pages, 'categories' => $categories, 'params' => RequestUtil::getParams()));
    }

    public function deleteProject($project_id)
    {
        if (!$project_id)
            $this->message('项目ID不能为空！');

        if ((new CurdUtil($this->projectModel))->update(array('project_id' => $project_id), array('disabled' => 1)))
            $this->message('删除项目成功！', 'project/index');
        else
            $this->message('删除项目失败！', 'project/index');
    }

    public function updateProject($project_id)
    {
        if (RequestUtil::isPost()) {
            if ($this->projectModel->rules()->run()) {
                $params = RequestUtil::postParams();
                $upload = UploadUtil::commonUpload(array('upload/resize_200x200',
                    'upload/resize_600x600','upload/resize_100x100'));

                if ($upload)
                    $params['project_cover'] = $upload;

                if ((new CurdUtil($this->projectModel))->update(array('project_id' => $project_id), $params))
                    $this->message('修改项目成功!', 'project/updateProject/' . $project_id);
                else
                    $this->message('修改项目失败!', 'project/updateProject/' . $project_id);
            }

        }

        $categories = (new CategoryModel())->getAllCategories();
        $shops = (new ShopModel())->getAllShops();
        $project = $this->projectModel->readOne($project_id);
        if (!$project)
            $this->message('项目不存在或者已被删除！', 'project/index');

        $this->view('project/updateProject', array('categories' => $categories, 'project' => $project, 'shops' => $shops));

    }

    public function addProject()
    {
        if (RequestUtil::isPost()) {
            if ($this->projectModel->rules()->run()) {
                $params = RequestUtil::postParams();

                $params['project_cover'] = UploadUtil::commonUpload(array('upload/resize_200x200',
                    'upload/resize_600x600','upload/resize_100x100'));

                $insertId = (new CurdUtil($this->projectModel))->
                    create(array_merge($params, array('create_time' => DateUtil::now())));

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