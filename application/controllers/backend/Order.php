<?php
/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 15-12-14
 * Time: 下午10:52
 */

class Order extends BackendController
{
    public function index()
    {
        $this->view('order/index');
    }

    public function orderDetail()
    {
        $this->view('order/orderDetail');
    }
} 