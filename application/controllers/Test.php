<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 2017/4/15
 * Time: 18:00
 */
class Test extends FrontendController
{
    public function index() {
        // 黄丽敏
        echo EncryptUtil::encrypt('o0GaXwMURjnGd8Vz1UdOrFGftYbg') . "<br>";
        //小小
        echo EncryptUtil::encrypt('o0GaXwLqRRCTzJMbX5TcDVC9TXd4') . "<br>";

        // 虎头
        echo EncryptUtil::encrypt('o0GaXwKD9eFiGKE4SROMG20j6iWo') . "<br>";
    }

    public function percent() {
        var_dump(EarningsPercentUtil::getPercent(200));
        var_dump(EarningsPercentUtil::getPercent(10000));
    }

    public function clearShare()
    {
        ShareUtil::clearShareForm();
    }

    public function orderPayed()
    {
        $orderNo = '201704162243510408643008';
        (new MakerOrderModel())->setOrderPayed($orderNo);
    }
}