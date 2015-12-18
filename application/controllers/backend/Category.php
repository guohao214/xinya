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
        $categories = $this->categoryModel->readAll();
        $this->view('category/index', array('categories' => $categories));
    }

    public function addCategory()
    {
        if (RequestUtil::isPost()) {
            if ($this->categoryModel->rules()->run()) {
                $curd = new CurdUtil($this->categoryModel);
                $params = RequestUtil::postParams();
                $insertId = $curd->create(array('category_name' => $params['category_name'],
                    'create_time' => DateUtil::now()));
                if ($insertId)
                    $this->message('插入成功!');
                else
                    $this->message('插入失败!');
            }

        }

        $this->view('category/addCategory');
    }

    public function updateCategory($categoryId)
    {
        if (!$categoryId)
            $this->message('分类ID错误!');

        if (RequestUtil::isPost()) {
            if ($this->categoryModel->rules()->run()) {
                $params = RequestUtil::postParams();
                $affectedRows = (new CurdUtil($this->categoryModel))->update(array('category_id' => $categoryId),
                    array('category_name' => $params['category_name']));

                if ($affectedRows > 0)
                    $this->message('修改分类信息成功!');
                else
                    $this->message('修改分类信息失败!');
            }

        }

        $category = (new CurdUtil($this->categoryModel))->readOne(array('category_id' => $categoryId));
        $category = array_pop($category);

        if (!$category)
            $this->message('分类不存在！');

        $this->view('category/updateCategory', $category);
    }

    public function deleteCategory($categoryId)
    {
        if (!$categoryId)
            $this->message('分类ID错误!');

        $where = array('category_id' => $categoryId);

        //查询总数
        if ((new CurdUtil(new ProjectModel()))->count($where) > 0)
            $this->message('当前分类下还有未删除的项目！，请先删除项目再删除分类！');

        if ((new CurdUtil($this->categoryModel))->delete(array('category_id' => $categoryId)))
            $this->message('删除分类成功！');
        else
            $this->message('删除分类失败！');
    }
} 