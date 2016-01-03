<?php
/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 2015/12/24
 * Time: 23:36
 */
class Shop extends FrontendController
{
    public function index()
    {
        $this->output->cache($this->cacheTime);
        $shops = (new ShopModel())->allShops();
        $this->view('shop/index', array('shops' => $shops));
    }
}