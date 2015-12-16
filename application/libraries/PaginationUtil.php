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

        $config['total_rows'] = $totalSize;
        $config['base_url'] = RequestUtil::CM();

        $instance->load->library('pagination', $config);
        $this->pagination = $instance->pagination;
    }

    public function pagination()
    {
        return $this->pagination->create_links();
    }
}