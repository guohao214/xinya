<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 15-12-13
 * Time: 下午1:01
 */
class FrontController extends CI_Controller
{
    /**
     * 用于layout布局的view操作
     * @param $view
     * @param array $vars
     * @param string $layout
     */
    public function view($view, $vars = array(), $layout = 'main-layout')
    {
        $render = $this->load->view($view, $vars, true);
        $this->load->view($layout . '.php', array('content' => $render));
    }
}