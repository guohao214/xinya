<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 15-12-14
 * Time: 下午10:52
 */
class Category extends BackendController
{
    public function index()
    {
        $this->view('category/index');
    }

    public function addCategory()
    {
        if (RequestUtil::isPost()) {
            $this->load->model('CategoryModel', 'categoryModel');
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