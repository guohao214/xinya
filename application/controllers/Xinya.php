<?php

/**
 * 首页
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 15-12-13
 * Time: 下午1:00
 */
class Xinya extends FrontendController
{

    /**
     * 首页
     */
    public function index()
    {
        // 此处需要做缓存
        $projects = (new ProjectModel())->allProjectsGroupByCategoryId();
        $shops = (new ShopModel())->getAllShops();
        $categories = (new CategoryModel())->readAllAssoc();

        $this->view('index/index', array('shops' => $shops, 'projects' => $projects, 'categories' => $categories));
    }

    /**
     * 添加到购物车
     */
    public function addCart()
    {

    }

}