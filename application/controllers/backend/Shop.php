<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 15-12-14
 * Time: 下午10:52
 */
class Shop extends BackendController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ShopModel', 'shopModel');
        // 删除所有的缓存
        $this->shopModel->deleteShopCache();
    }


    public function index($limit = '')
    {
        $where = RequestUtil::likeParamsWithDisabled();

        $shops = (new CurdUtil($this->shopModel))->readLimit($where, $limit);
        $shopsCount = (new CurdUtil($this->shopModel))->count($where);
        $pages = (new PaginationUtil($shopsCount))->pagination();

        $this->view('shop/index', array('shops' => $shops,
            'pages' => $pages, 'params' => RequestUtil::getParams()));
    }

    /**
     * 删除店铺
     * @param $shop_id
     */
    public function deleteShop($shop_id)
    {
        if (!$shop_id)
            $this->message('店铺ID不能为空！');

        if ((new CurdUtil($this->shopModel))->update(array('shop_id' => $shop_id), array('disabled' => 1)))
            $this->message('删除店铺成功！', 'shop/index');
        else
            $this->message('删除店铺失败！', 'shop/index');
    }

    private function processUpload($pic = 'pic')
    {
        if ($_FILES[$pic]['size'] <= 0)
            return '';

        $upload = new UploadUtil('upload/image');
        $data = $upload->upload($pic);
        if ($data['error'] == 0) {
            // 缩略图
            $upload->resizeImage(array('upload/resize_200x200', 'upload/resize_100x100'), $data['data']);
            return json_encode($data['data']);
        } else {
            $this->message('图片上传失败，请重试！' . $data['data']);
        }
    }

    public function updateShop($shop_id)
    {
        if (RequestUtil::isPost()) {
            if ($this->shopModel->rules()->run()) {
                $params = RequestUtil::postParams();

                $upload = $this->processUpload();
                if ($upload)
                    $params['shop_logo'] = $upload;

                if ((new CurdUtil($this->shopModel))->update(array('shop_id' => $shop_id), $params))
                    $this->message('修改店铺成功!', 'shop/updateShop/' . $shop_id);
                else
                    $this->message('修改店铺失败!', 'shop/updateShop/' . $shop_id);
            }
        }

        $shop = (new CurdUtil($this->shopModel))->readOne(array('shop_id' => $shop_id, 'disabled' => 0));
        if (!$shop)
            $this->message('店铺不存在或者已被删除！', 'shop/index');

        $this->view('shop/updateShop', array('shop' => $shop));

    }

    /**
     * 添加店铺
     */
    public function addShop()
    {
        if (RequestUtil::isPost()) {
            if ($this->shopModel->rules()->run()) {
                $params = RequestUtil::postParams();
                $params['shop_logo'] = $this->processUpload();

                $insertId = (new CurdUtil($this->shopModel))->
                create(array_merge($params, array('create_time' => DateUtil::now())));

                if ($insertId)
                    $this->message('新增店铺成功!', 'shop/index');
                else
                    $this->message('新增店铺失败!', 'shop/index');
            }

        }

        $this->view('shop/addShop');
    }
} 