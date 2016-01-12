<?php

class ShopModel extends BaseModel
{
    private $cacheName = 'shops';

    public function setTable()
    {
        $this->table = 'shop';
    }

    public function deleteShopCache()
    {
        $this->deleteCache($this->cacheName);
    }

    public function allShops()
    {
        $shops = $this->getCache($this->cacheName);

        if (!$shops) {
            $shops = (new CurdUtil($this))->readAll('create_time desc', array('disabled' => 0));
            $this->setCache($this->cacheName, $shops);
        }

        return $shops;
    }

    public function getAllShops()
    {
        $shops = $this->allShops();
        $_shops = array();

        foreach ($shops as $shop) {
            $_shops[$shop['shop_id']] = $shop['shop_name'];
        }

        return $_shops;
    }

    public function rules()
    {
        // 添加验证
        $validate = new ValidateUtil();

        $validate->required('shop_name');
        $validate->required('address');

        $validate->minLength('shop_name', 1);
        $validate->maxLength('shop_name', 100);

        $validate->minLength('address', 1);
        $validate->maxLength('address', 100);

        $validate->minLength('contacts', 1);
        $validate->maxLength('contacts', 50);

        $validate->minLength('contact_number', 1);
        $validate->maxLength('contact_number', 32);


        return $validate;
    }

    /**
     * 检测是否为有效的店铺ID
     * @param $shopId
     * @return  bool
     */
    public function isValidShopId($shopId)
    {
        $shopId += 0;
        $shops = $this->getAllShops();

        return (array_key_exists($shopId, $shops));
    }
} 