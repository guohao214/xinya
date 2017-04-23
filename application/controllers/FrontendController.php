<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 15-12-13
 * Time: 下午1:01
 */
class FrontendController extends BaseController
{
    public $pageTitle = '不期而遇美容连锁';
    public $cacheTime = 600;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 获得分享js
     * @param $currentUrl
     */
    public function wechatShare()
    {
        $scheme = $_SERVER['REQUEST_SCHEME'] ? $_SERVER['REQUEST_SCHEME'] : 'http';
        $scheme .= '://';

        $httpHost = $_SERVER['HTTP_HOST']
            ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME']
                ? $_SERVER['SERVER_NAME'] : 'www.xinyameirong.com';

        $currentUrl = $scheme . $httpHost . $_SERVER['REQUEST_URI'];

        $shareJsParams = (new WxShareUtil())->getShareParams($currentUrl);

        // 获得头像
        $this->load->view('frontend/wechatShare', array('shareJsParams' => $shareJsParams));
    }

    public function noContent($message) {
        $this->load->view('frontend/noContent', array('message' => $message));
    }

    /**
     * 用于前台 layout布局的view操作
     * @param $view
     * @param array $vars
     */
    public function view($view, $vars = array())
    {
        parent::see('frontend', $view, $vars);
    }

    /**
     * 页面缓存
     * @param string $cacheTime
     * @return bool
     */
    public function outputCache($cacheTime = '')
    {
        return true;

        if (!$cacheTime)
            $cacheTime = $this->cacheTime;

        $this->output->cache($cacheTime);
    }

}