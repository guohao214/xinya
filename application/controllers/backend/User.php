<?php
/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 15-12-14
 * Time: 下午10:52
 */

class User extends BackendController
{
    public function index()
    {
        $this->view('user/index');
    }

    public function addUser()
    {
        $this->view('user/addUser');
    }

} 