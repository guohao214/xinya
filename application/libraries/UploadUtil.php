<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-12-15
 * Time: 下午6:18
 */
class UploadUtil
{
    private $upload;
    private $instance;

    public function __construct($uploadType)
    {
        $this->instance = get_instance();
        $config = $this->loadConfig($uploadType);

        $this->instance->load->library('upload', $config);

        $this->upload = $this->instance->upload;
    }

    private function loadConfig($config)
    {
        $configPath = APPPATH . 'config' . DS . 'upload' . DS . $config . '.php';
        return include $configPath;
    }

    public function upload($uploadElement)
    {
        $return = array('error' => 0, 'data' => array());

        if (!$this->upload->do_upload($uploadElement)) {
            $return['error'] = 1;
            $return['data'] = array('error' => $this->upload->display_errors());

        } else {
            $return['error'] = 0;
            $return['data'] = array('upload_data' => $this->upload->data());
        }

        return $return;
    }

    /**
     * 缩略图
     * @param $resizeType
     * @param $upload
     */
    public function resizeImage($resizeType, $upload)
    {
        if (!is_array($resizeType))
            $resizeType = array($resizeType);

        $this->instance->load->library('image_lib');

        foreach ($resizeType as $type) {
            $config = $this->loadConfig($type);
            $config['source_image'] = $upload['full_path'];

            $this->instance->image_lib->initialize($config);

            $this->instance->image_lib->resize();
            $this->instance->image_lib->clear();
        }
    }
} 