<?php

/**
 * 店铺
 * User: GuoHao
 * Date: 2015/12/24
 * Time: 23:36
 */
class Shop extends FrontendController
{
    /**
     * 展示店铺
     */
    public function index()
    {
        $returnUrl = $this->input->get('returnUrl', true);

        if ($returnUrl)
            $returnUrl = urldecode($returnUrl);

        if (!$returnUrl || !UrlUtil::isValidUrl($returnUrl))
            $returnUrl = UrlUtil::createUrl('project/index');

        $this->outputCache();
        $shops = (new ShopModel())->allShops();
        $this->view('shop/index', array('shops' => $shops, 'returnUrl' => $returnUrl));
    }
}