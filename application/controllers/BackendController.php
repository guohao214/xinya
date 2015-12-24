<?php

/**
 * 后台控制器
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 15-12-14
 * Time: 下午10:28
 */
class BackendController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 用于后台 layout布局的view操作
     * @param $view
     * @param array $vars
     */
    public function view($view, $vars = array())
    {
        parent::view('backend', $view, $vars);
    }

} 