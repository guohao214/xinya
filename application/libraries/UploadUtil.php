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
    private $date;

    public function __construct($uploadType)
    {
        $this->instance = get_instance();
        $config = ConfigUtil::loadConfig($uploadType);

        // 设置保存目录
        $this->date = date('Y-m-d');
        $uploadPath = $config['upload_path'] . DIRECTORY_SEPARATOR . $this->date;
        if (!is_dir($uploadPath) || !file_exists($uploadPath))
            mkdir($uploadPath);

        $config['upload_path'] = $uploadPath;

        $this->instance->load->library('upload', $config);

        $this->upload = $this->instance->upload;
    }

    public function upload($uploadElement)
    {
        $return = array('error' => 0, 'data' => array());

        if (!$this->upload->do_upload($uploadElement)) {
            $return['error'] = 1;
            $return['data'] = $this->upload->display_errors();

        } else {
            $return['error'] = 0;
            $return['data'] = $this->upload->data();
            $return['data']['raw_name'] = $this->date . '/' . $return['data']['raw_name'];
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
            $config = ConfigUtil::loadConfig($type);
            $config['source_image'] = $upload['full_path'];

            $this->instance->image_lib->initialize($config);

            $this->instance->image_lib->resize();
            $this->instance->image_lib->clear();
        }
    }

    /**
     * 拼装并返回上传文件路径
     * @param $imageString
     * @param string $size
     */
    public static function buildUploadDocPath($imageString, $size = '')
    {
        if (!is_array($imageString)) {
            $uploadDoc = json_decode($imageString, true);
            if (json_last_error() != JSON_ERROR_NONE)
                return '';
        } else {
            $uploadDoc = $imageString;
        }

        if ($size) {
            $docPath = "{$uploadDoc['raw_name']}_{$size}{$uploadDoc['file_ext']}";
        } else {
            $docPath = "{$uploadDoc['raw_name']}{$uploadDoc['file_ext']}";
        }

        if (file_exists(UPLOAD_FOLDER . DIRECTORY_SEPARATOR . $docPath))
            return get_instance()->config->base_url() . UPLOAD_FOLDER . '/' . $docPath;
        else
            return get_instance()->config->base_url() . UPLOAD_FOLDER . "/{$uploadDoc['file_name']}";
    }
} 