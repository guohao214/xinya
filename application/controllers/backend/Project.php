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
        $params = $_params = RequestUtil::getParams();
        if ($params) {
            array_walk($params, function (&$item, $key) {
                $item = "{$key} like '%{$item}%'";
            });
        }

        $params['disabled'] = 'disabled=0';
        $where = implode('and ', $params);

        $projects = (new CurdUtil($this->projectModel))->readLimit($where, $limit);
        $projectsCount = (new CurdUtil($this->projectModel))->count($where);
        $pages = (new PaginationUtil($projectsCount))->pagination();
        $categories = (new CategoryModel())->readAllAssoc();

        $this->view('project/index', array('projects' => $projects,
            'pages' => $pages, 'categories' => $categories));
    }

    public function addProject()
    {
        if (RequestUtil::isPost()) {
            if ($this->projectModel->rules()->run()) {
                $params = RequestUtil::postParams();

                // 上传文件
                $upload = new UploadUtil('upload/image');
                $data = $upload->upload('pic');
                if ($data['error'] == 0) {
                    $params['project_cover'] = json_encode($data['data']);
                } else {
                    $this->message('图片上传失败，请重试！' . $data['data']);
                }

                $insertId = (new CurdUtil($this->projectModel))->
                    create(array_merge($params, array('create_time' => DateUtil::now())));

                if ($insertId)
                    $this->message('新增项目成功!', 'project/index');
                else
                    $this->message('新增项目失败!', 'project/index');
            }

        }

        $categories = (new CategoryModel())->readAllAssoc();
        $this->view('project/addProject', array('categories' => $categories));
    }
} 