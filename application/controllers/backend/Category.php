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
        $this->categoryModel->deleteCacheCategories();
    }

    public function index()
    {
        $categories = $this->categoryModel->getAllCategoriesWithProjectCounts();
        $this->view('category/index', array('categories' => $categories));
    }

    public function addCategory()
    {
        if (RequestUtil::isPost()) {
            if ($this->categoryModel->rules()->run()) {
                $params = RequestUtil::postParams();
                $insertId = (new CurdUtil($this->categoryModel))->create(
                    array('category_name' => $params['category_name'], 'order_sort' => $params['order_sort'],
                        'create_time' => DateUtil::now()));

                if ($insertId)
                    $this->message('新增分类成功!', 'category/index');
                else
                    $this->message('新增分类失败!', 'category/index');
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
                    array('category_name' => $params['category_name'], 'order_sort' => $params['order_sort']));

                if ($affectedRows > 0)
                    $this->message('修改分类信息成功!', 'category/index');
                else
                    $this->message('修改分类信息失败!', 'category/index');
            }

        }

        $category = (new CurdUtil($this->categoryModel))->readOne(array('category_id' => $categoryId));

        if (!$category)
            $this->message('分类不存在！', 'category/index');

        $this->view('category/updateCategory', $category);
    }

    public function deleteCategory($categoryId)
    {
        if (!$categoryId)
            $this->message('分类ID错误!', 'category/index');

        $where = array('category_id' => $categoryId, 'disabled' => 0);

        //查询总数
        if ((new CurdUtil(new ProjectModel()))->count($where) > 0)
            $this->message('当前分类下还有未删除的项目！，请先删除项目再删除分类！');

        if ((new CurdUtil($this->categoryModel))->update(array('category_id' => $categoryId), array('disabled' => 1)))
            $this->message('删除分类成功！', 'category/index');
        else
            $this->message('删除分类失败！', 'category/index');
    }
} 