<?php

/**
 * 上传
 * User: Administrator
 * Date: 2015/12/28
 * Time: 12:54
 */
class Upload extends BackendController
{
    public $fileName = 'imgFile';

    public function index()
    {
        if ($_FILES[$this->fileName]['size'] <= 0)
            ResponseUtil::output(array('error' => 1, 'message' => '图片不能为空，请重试！'));

        $upload = new UploadUtil('upload/image');
        $data = $upload->upload($this->fileName);

        if ($data['error'] == 0) {
            // 缩略图
            $upload->resizeImage(array('upload/resize_350x350'), $data['data']);
            $imageUrl = UploadUtil::buildUploadDocPath($data['data'], '350x350');

            ResponseUtil::output(array('error' => 0, 'url' => $imageUrl));
        } else {
            ResponseUtil::output(array('error' => 1, 'message' => '图片上传失败！，请重试！'));
        }
    }
}