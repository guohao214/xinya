<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 15-12-13
 * Time: 下午1:01
 */
class FrontendController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * 用于前台 layout布局的view操作
     * @param $view
     * @param array $vars
     */
    public function view($view, $vars = array())
    {
       parent::view('frontend', $view, $vars);
    }

}