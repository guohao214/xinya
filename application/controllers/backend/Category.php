<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 15-12-14
 * Time: 下午10:52
 */
class Category extends BackendController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('CategoryModel', 'categoryModel');
    }

    public function index()
    {
      //  $categories = (new CurdUtil($this->categoryModel))->readAll('create_time desc', array('disabled' => 0));

var_dump($this->categoryModel->readAll());

        $this->view('category/index', array('categories' => $categories));
    }

    public function addCategory()
    {
        if (RequestUtil::isPost()) {
            
            // 添加验证
            $validate = new ValidateUtil();
            $validate->required('category_name');
            if ($validate->run()) {
                $curd = new CurdUtil($this->categoryModel);
                $postParams = RequestUtil::postParams();
                $insertId = $curd->create(array('category_name' => $postParams['category_name'],
                    'create_time' => DateUtil::now()));
                if ($insertId)
                    $this->message('插入成功!');
                else
                    $this->message('插入失败!');
            }

        }

        $this->view('category/addCategory');
    }
} 