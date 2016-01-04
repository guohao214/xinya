<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 2016/1/2
 * Time: 23:55
 */
class Slider extends BackendController
{
    private $sliderModel;

    public function __construct()
    {
        parent::__construct();
        $this->sliderModel = new SliderModel();
    }

    public function index()
    {
        $sliders = $this->sliderModel->getAllSlider();
        $this->view('slider/index', array('sliders' => $sliders));
    }

    public function addSlider()
    {
        if (RequestUtil::isPost()) {
            $this->sliderModel->deleteSliderCache();
            $params = RequestUtil::postParams();

            // href
            if (!preg_match('~^http[s]?://~', $params['href']))
                $params['href'] = 'http://' . $params['href'];

            if ($this->sliderModel->rules()->run()) {

                $params['pic'] = $this->processUpload();

                $insertId = (new CurdUtil($this->sliderModel))->
                create(array_merge($params, array('create_time' => DateUtil::now())));

                if ($insertId)
                    $this->message('新增幻灯片成功!', 'slider/index');
                else
                    $this->message('新增幻灯片失败!', 'slider/index');
            }

        }

        $this->view('slider/addSlider');
    }

    private function processUpload($pic = 'pic')
    {
        if ($_FILES[$pic]['size'] <= 0)
            return '';

        $upload = new UploadUtil('upload/image');
        $data = $upload->upload($pic);
        if ($data['error'] == 0) {
            // 缩略图
            $upload->resizeImage(array('upload/resize_200x200', 'upload/resize_600x600'), $data['data']);
            return json_encode($data['data']);
        } else {
            $this->message('图片上传失败，请重试！' . $data['data']);
        }
    }

    public function deleteSlider($sliderId)
    {
        if (!$sliderId)
            $this->message('幻灯片ID不能为空！');

        $this->sliderModel->deleteSliderCache();

        if ((new CurdUtil($this->sliderModel))->update(array('slider_id' => $sliderId), array('disabled' => 1)))
            $this->message('删除幻灯片成功！', 'slider/index');
        else
            $this->message('删除幻灯片失败！', 'slider/index');
    }
}