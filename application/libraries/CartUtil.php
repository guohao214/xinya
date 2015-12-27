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
    private $cartSign = '__xinya_cart';

    /**
     * CartUtil constructor.
     */
    public function __construct()
    {
        $this->cart = &$_SESSION;
        if (!isset($this->cart[$this->cartSign]))
            $this->cart[$this->cartSign] = array();
    }

    public function addCart($projectId)
    {
        $cart = &$this->cart[$this->cartSign];

        if (isset($cart[$projectId]))
            return $cart[$projectId] += 1;
        else
            return $cart[$projectId] = 1;
    }

    public function deleteCart($projectId)
    {
        $cart = &$this->cart[$this->cartSign];

        if (isset($cart[$projectId]) && $cart[$projectId] > 0)
            return $cart[$projectId] -= 1;
        else
            return $cart[$projectId] = 0;
    }

    public function cart()
    {
        return array_filter($this->cart[$this->cartSign]);
    }
}