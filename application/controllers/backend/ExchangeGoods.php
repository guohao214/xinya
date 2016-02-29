<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 2016/2/29
 * Time: 21:40
 */
class ExchangeGoods extends BackendController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ExchangeGoodsModel', 'exchangeGoodsModel');
    }

    public function index($limit = '')
    {
        $where = RequestUtil::buildLikeQueryParamsWithDisabled();
        $exchangeGoods = (new CurdUtil($this->exchangeGoodsModel))->readLimit($where, $limit, 'exchange_goods_id desc');
        $exchangeGoodsCount = (new CurdUtil($this->exchangeGoodsModel))->count($where);
        $pages = (new PaginationUtil($exchangeGoodsCount))->pagination();
        $shops = (new ShopModel())->getAllShops();
        $this->view('exchangeGoods/index', array('exchangeGoods' => $exchangeGoods, 'limit' => $limit + 0,
            'pages' => $pages, 'params' => RequestUtil::getParams(), 'shops' => $shops));
    }

    /**
     * 新增优惠券
     */
    public function addExchangeGoods()
    {
        if (RequestUtil::isPost()) {
            if ($this->exchangeGoodsModel->rules()->run()) {
                $params = RequestUtil::postParams();
                $params['remain_number'] = $params['total_number'];

                $params['exchange_goods_pic'] = UploadUtil::commonUpload(array('upload/resize_200x200',
                    'upload/resize_600x600', 'upload/resize_100x100'));

                $insertId = (new CurdUtil($this->exchangeGoodsModel))
                    ->create(array_merge($params, array('create_time' => DateUtil::now())));

                if ($insertId)
                    $this->message('新增兑换商品成功!', 'exchangeGoods/index');
                else
                    $this->message('新增兑换商品失败!', 'exchangeGoods/index');
            }
        }

        $this->view('exchangeGoods/addExchangeGoods');
    }

    public function updateExchangeGoods($exchangeGoodsId, $limit='')
    {
        if (RequestUtil::isPost()) {
            if ($this->exchangeGoodsModel->rules()->run()) {
                $params = RequestUtil::postParams();
                $upload = UploadUtil::commonUpload(array('upload/resize_200x200',
                    'upload/resize_600x600', 'upload/resize_100x100'));

                if ($upload)
                    $params['exchange_goods_pic'] = $upload;

                if ((new CurdUtil($this->exchangeGoodsModel))->update(array('exchange_goods_id' => $exchangeGoodsId), $params))
                    $this->message('修改兑换商品成功!', 'exchangeGoods/updateExchangeGoods/' . $exchangeGoodsId ."/{$limit}");
                else
                    $this->message('修改兑换商品失败!', 'exchangeGoods/updateExchangeGoods/' . $exchangeGoodsId ."/{$limit}");
            }

        }

        $shops = (new ShopModel())->getAllShops();
        $exchangeGoods = $this->exchangeGoodsModel->readOne($exchangeGoodsId);
        if (!$exchangeGoods)
            $this->message('兑换商品不存在或者已被删除！', "exchangeGoods/index/{$limit}");

        $this->view('exchangeGoods/updateExchangeGoods', array('exchangeGoods' => $exchangeGoods,
            'shops' => $shops, 'limit' => $limit));
    }


    public function deleteExchangeGoods($exchangeGoodsId, $limit = 0)
    {
        if (!$exchangeGoodsId)
            $this->message('兑换商品不能为空！');

        if ((new CurdUtil($this->exchangeGoodsModel))->update(array('exchange_goods_id' => $exchangeGoodsId), array('disabled' => 1)))
            $this->message('删除兑换商品成功！', "exchangeGoods/index/{$limit}");
        else
            $this->message('删除兑换商品失败！', "exchangeGoods/index/{$limit}");
    }
}