<?php
/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 15-12-14
 * Time: 下午10:52
 */

class Category extends BackendController
{
    public function index()
    {
        $this->view('category/index');
    }

    public function addCategory()
    {
        $this->view('category/addCategory');
    }
} 