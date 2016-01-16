<?php

class SliderModel extends BaseModel
{
    public $sliderCacheName = '__xinya_slider';

    const SLIDER_TYPE_HDP = '幻灯片'; // 幻灯片
    const SLIDER_TYPE_FLL = '福利栏'; // 福利栏

    public function setTable()
    {
        $this->table = 'slider';
    }


    public function rules()
    {
        // 添加验证
        $validate = new ValidateUtil();

        $validate->required('title');
        $validate->required('href');
        $validate->required('order_sort');

        $validate->minLength('title', 1);
        $validate->maxLength('title', 50);

        $validate->minLength('href', 1);
        $validate->maxLength('href', 500);

        $validate->numeric('order_sort');
        $validate->url('href');

        return $validate;
    }

    public function readOne($sliderId)
    {
        return (new CurdUtil($this))->readOne(array('slider_id' => $sliderId, 'disabled' => 0));
    }

    public function getAllSlider()
    {
        $sliders = $this->getCache($this->sliderCacheName);
        if (!$sliders) {
            $sliders = (new CurdUtil($this))->readAll('order_sort desc', array('disabled' => 0));
            $this->setCache($this->sliderCacheName, $sliders);
        }

        return $sliders;
    }

    public function deleteSliderCache()
    {
        $this->deleteCache($this->sliderCacheName);
    }

} 