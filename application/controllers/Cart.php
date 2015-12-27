<?php

/**
 * 购物车
 * User: GuoHao
 * Date: 2015/12/26
 * Time: 23:31
 */
class Cart extends FrontendController
{
    public function index()
    {
        $cart = (new CartUtil())->cart();
        $projectIds = array_keys($cart);
        $projects = array();
        if (!empty($cart) && !empty($projectIds)) {
            // 查询所有的项目
            $projects = (new ProjectModel())->readByProjectIds($projectIds);
        }

        $shops = (new ShopModel())->getAllShops();
        $categories = (new CategoryModel())->readAllAssoc();
        $this->view('cart/index', array('shops' => $shops, 'projects' => $projects,
            'categories' => $categories, 'cart' => $cart));
    }

    public function addCart($projectId)
    {
        if (!$projectId)
            $this->message('错误的项目ID');

        $projectId += 0;

        (new CartUtil())->addCart($projectId);
        session_write_close();
        ResponseUtil::executeSuccess('添加到购物车成功!');
    }

    public function deleteCart($projectId)
    {
        if (!$projectId)
            $this->message('错误的项目ID');

        $projectId += 0;

        (new CartUtil())->deleteCart($projectId);
        session_write_close();
        ResponseUtil::executeSuccess('从购物车删除成功!');
    }
}