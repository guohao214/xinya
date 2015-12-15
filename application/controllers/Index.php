<?php

/**
 * 首页
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 15-12-13
 * Time: 下午1:00
 */
class Index extends FrontendController
{
    /**
     * 首页
     */
    public function index1()
    {
        $upload = new UploadUtil('image');

        $data = $upload->upload('userfile');
        var_dump($data);
        $upload->resizeImage(array('resize_31x31', 'resize_100x100'), $data['data']['upload_data']);
    }

    /**
     * 添加到购物车
     */
    public function addCart()
    {

    }

}