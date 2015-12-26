<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 2015/12/26
 * Time: 23:39
 */
class UserCenter extends FrontendController
{
    public function index()
    {
        $this->view('userCenter/index');
    }

    public function order()
    {
        $this->view('userCenter/order');
    }
}