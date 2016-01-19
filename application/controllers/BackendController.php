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
    /**
     * 店长允许操作的
     * @var array
     */
    public $shopKeeperPermissions = array('beautician' => '*', 'order' => '*', 'user' => array('changepassword', 'index'));

    public function __construct()
    {
        parent::__construct();

        if (!UserUtil::getUserId())
            ResponseUtil::redirect(UrlUtil::createBackendUrl('login'));

        $controller = strtolower($this->router->class);
        $method = strtolower($this->router->method);
        if (UserUtil::isShopKeeper()) {
            if (!array_key_exists($controller, $this->shopKeeperPermissions))
                $this->message('你没有权限执行本步骤!');

            $methods = $this->shopKeeperPermissions[$controller];
            if ($methods == '*')
                return true;
            else if (!in_array($method, $methods))
                $this->message('你没有权限执行本步骤!');
            else
                return true;
        }
    }

    /**
     * 用于后台 layout布局的view操作
     * @param $view
     * @param array $vars
     */
    public function view($view, $vars = array())
    {
        parent::see('backend', $view, $vars);
    }

    public function message($message, $returnBack = '')
    {
        if ($returnBack)
            $returnBack = 'backend/' . $returnBack;

        parent::message($message, $returnBack);
    }

} 