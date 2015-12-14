<?php
/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 15-12-14
 * Time: 下午10:52
 */

class Project extends BackendController
{
    public function index()
    {
        $this->view('project/index');
    }

    public function addProject()
    {
        $this->view('project/addProject');
    }
} 