<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 2015/12/26
 * Time: 23:31
 */
class Cart extends FrontendController
{
    public function index()
    {
        $this->view('cart/index');
    }
}