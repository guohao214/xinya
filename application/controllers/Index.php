<?php

/**
 * 首页
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 15-12-13
 * Time: 下午1:00
 */
include 'Front.php';

class Index extends Front
{
    /**
     * 首页
     */
    public function index1()
    {
        $this->view('index/index');
    }

    /**
     * 添加到购物车
     */
    public function addCart()
    {

    }
}