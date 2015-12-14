<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 15-12-14
 * Time: 下午10:35
 */
class Login extends BackendController
{
    public function index()
    {
        $this->load->view('backend/login');
    }

    public function doLogin()
    {

    }
} 