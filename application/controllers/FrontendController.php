<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 15-12-13
 * Time: 下午1:01
 */
class FrontendController extends CI_Controller
{
    /**
     * 用于layout布局的view操作
     * @param $view
     * @param array $vars
     */
    public function view($view, $vars = array())
    {
        $render = $this->load->view($view, $vars, true);
        $this->load->view('frontend/layout', array('content' => $render));
    }
}