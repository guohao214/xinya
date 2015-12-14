<?php
/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 15-12-13
 * Time: 下午1:01
 */

abstract class Front extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }


    /**
     * 用于layout布局的view操作
     * @param $view
     * @param array $vars
     * @param string $layout
     */
    protected function view($view, $vars = array(), $layout = 'main-layout')
    {
        $render = $this->load->view($view, $vars, true);
        $this->load->view($layout . '.php', array('content' => $render));
    }
}