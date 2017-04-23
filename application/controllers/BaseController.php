<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 2015/12/24
 * Time: 21:58
 */
abstract class BaseController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'form', 'security', 'common'));
        load_class('Model', 'core');
    }

    public function see($layout, $view, $vars = array())
    {
        $layout = $layout . DS;
        $render = $this->load->view($layout . $view, $vars, true);
        $this->load->view($layout . 'layout', array('content' => $render));
    }

    public function message($message, $returnBack = '')
    {
//        $this->load->view('frontend/noContent', array('message' => $message));
//        exit;
//        show_error($message);
//        exit;
        if ($returnBack)
            $returnBack = UrlUtil::createUrl($returnBack);

        $this->view('message', array('message' => $message, 'returnBack' => $returnBack));
        $this->output->_display();
        exit;
    }
}