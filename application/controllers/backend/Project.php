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
            'pages' => $pages, 'categories' => $categories, 'params' => $_params));
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

    private function processUpload($pic = 'pic')
    {
        if ($_FILES[$pic]['size'] <= 0)
            return '';

        $upload = new UploadUtil('upload/image');
        $data = $upload->upload($pic);
        if ($data['error'] == 0) {
            // 缩略图
            $upload->resizeImage(array('upload/resize_200x200'), $data['data']);
            return json_encode($data['data']);
        } else {
            $this->message('图片上传失败，请重试！' . $data['data']);
        }
    }

    public function updateProject($project_id)
    {
        if (RequestUtil::isPost()) {
            if ($this->projectModel->rules()->run()) {
                $params = RequestUtil::postParams();

                $upload = $this->processUpload();
                if ($upload)
                    $params['project_cover'] = $upload;

                if ((new CurdUtil($this->projectModel))->update(array('project_id' => $project_id), $params))
                    $this->message('修改项目成功!', 'project/updateProject/' . $project_id);
                else
                    $this->message('修改项目失败!', 'project/updateProject/' . $project_id);
            }

        }

        $categories = (new CategoryModel())->readAllAssoc();
        $project = (new CurdUtil($this->projectModel))->readOne(array('project_id' => $project_id, 'disabled' => 0));
        if (!isset($project[0]))
            $this->message('项目不存在或者已被删除！', 'project/index');

        $this->view('project/updateProject', array('categories' => $categories, 'project' => array_pop($project)));

    }

    public function addProject()
    {
        if (RequestUtil::isPost()) {
            if ($this->projectModel->rules()->run()) {
                $params = RequestUtil::postParams();

                $params['project_cover'] = $this->processUpload();

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