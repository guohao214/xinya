<?php

class SliderModel extends BaseModel
{
    public $sliderCacheName = 'slider';

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

    /**
     * 获得所有的幻灯片
     * @param $sliderType 类型
     * @return array
     */
    public function getSliders($sliderType)
    {
        $sliders = $this->getAllSlider();
        $_sliders = array();
        foreach ($sliders as $slider) {
            if ($slider['slider_type'] == $sliderType)
                $_sliders[] = $slider;
            else
                continue;
        }

        return $_sliders;
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