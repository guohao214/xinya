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
    public $shopKeeperPermissions = array('beautician', 'order');

    public function __construct()
    {
        parent::__construct();

        if (!UserUtil::getUserId())
            ResponseUtil::redirect(UrlUtil::createBackendUrl('login'));

        $controller = strtolower($this->router->class);
        if (UserUtil::isShopKeeper() && !in_array($controller, $this->shopKeeperPermissions))
            $this->message('你没有权限执行本步骤!');
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
            $returnBack = 'backend/'. $returnBack;

        parent::message($message, $returnBack);
    }

} 