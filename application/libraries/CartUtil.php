<?php

/**
 * 购物车工具
 * User: GuoHao
 * Date: 2015/12/27
 * Time: 13:02
 */
class CartUtil
{
    private $cart;
    private $cartSign = '__xinya_cart_project';

    /**
     * CartUtil constructor.
     */
    public function __construct()
    {
        $this->cart = &$_SESSION;
        if (!isset($this->cart[$this->cartSign]))
            $this->cart[$this->cartSign] = 0;
    }

    /**
     * 添加到购物车
     *
     * @param $projectId
     * @return int
     */
    public function addCart($projectId)
    {
        $this->cart[$this->cartSign] = $projectId;
    }

    public function deleteCart()
    {
        unset($this->cart[$this->cartSign]);
    }

    public function cart()
    {
        return $this->cart[$this->cartSign];
    }

    public function emptyCart()
    {
        unset($this->cart[$this->cartSign]);
    }
}