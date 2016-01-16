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

                $params['pic'] = UploadUtil::commonUpload(array('upload/resize_200x200', 'upload/resize_100x100',
                    'upload/resize_600x600'));

                $insertId = (new CurdUtil($this->sliderModel))->
                create(array_merge($params, array('create_time' => DateUtil::now())));

                if ($insertId)
                    $this->message('新增成功!', 'slider/index');
                else
                    $this->message('新增失败!', 'slider/index');
            }

        }

        $this->view('slider/addSlider');
    }

    public function deleteSlider($sliderId)
    {
        if (!$sliderId)
            $this->message('ID不能为空！');

        $this->sliderModel->deleteSliderCache();

        if ((new CurdUtil($this->sliderModel))->update(array('slider_id' => $sliderId), array('disabled' => 1)))
            $this->message('删除成功！', 'slider/index');
        else
            $this->message('删除失败！', 'slider/index');
    }

    public function updateSlider($sliderId)
    {
        if (!$sliderId)
            $this->message('ID不能为空！');

        if (RequestUtil::isPost()) {
            $this->sliderModel->deleteSliderCache();
            $params = RequestUtil::postParams();

            // href
            if (!preg_match('~^http[s]?://~', $params['href']))
                $params['href'] = 'http://' . $params['href'];


            if ($this->sliderModel->rules()->run()) {

                $upload = UploadUtil::commonUpload(array('upload/resize_200x200', 'upload/resize_100x100',
                    'upload/resize_600x600'));
                if ($upload)
                    $params['pic'] = $upload;

                $returnUrl = 'slider/updateSlider/' . $sliderId;
                if ((new CurdUtil($this->sliderModel))->update(array('slider_id' => $sliderId), $params))
                    $this->message('修改成功!', $returnUrl);
                else
                    $this->message('修改失败!', $returnUrl);
            }
        }

        $slider = (new CurdUtil($this->sliderModel))->readOne(array('slider_id' => $sliderId, 'disabled' => 0));
        if (!$slider)
            $this->message('记录不存在或者已被删除！', 'slider/index');

        $this->view('slider/updateSlider', array('slider' => $slider));

    }
}