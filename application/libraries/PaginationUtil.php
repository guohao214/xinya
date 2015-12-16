<?php

/**
 * 分页
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-12-16
 * Time: 上午11:04
 */
class PaginationUtil
{
    private $pagination;

    public function __construct($totalSize = 0, $config = 'pagination')
    {
        $config = ConfigUtil::loadConfig($config);
        $instance = get_instance();
        $segments = $instance->uri->segments;
        //取第一个数组元素
        $controller = array_shift($segments);
        $baseUrl = $controller . '/' . array_shift($segments);

        // 在controllers里判断 是不是目录
        if (is_dir(APPPATH . 'controllers' . DS . $controller)) {
            $baseUrl .= '/' . array_shift($segments);
        }

        $config['total_rows'] = $totalSize;
        $config['base_url'] = $instance->config->base_url() . $baseUrl;

        $instance->load->library('pagination', $config);
        $this->pagination = $instance->pagination;
    }

    public function pagination()
    {
        return $this->pagination->create_links();
    }
}