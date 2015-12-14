<?php

/**
 * 后台控制器
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 15-12-14
 * Time: 下午10:28
 */
class BackendController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('ViewUtil');
        $this->load->library('UrlUtil');

        ViewUtil::setBackendStaticPath(base_url() . 'static/backend/');
    }

    /**
     * 用于后台 layout布局的view操作
     * @param $view
     * @param array $vars
     */
    public function view($view, $vars = array())
    {
        $layout = 'backend' . DS;
        $render = $this->load->view($layout . $view, $vars, true);
        $this->load->view($layout . 'layout', array('content' => $render));
    }
} 