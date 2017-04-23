<?php

/**
 * 产品分类
 */
class ProjectCategory extends FrontendController
{
    public function index() {
        $categories = (new CategoryModel())->getAllCategories();
        $this->view('projectCategory/index', array('categories' => $categories));
    }
}