<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/29
 * Time: 13:37
 */
class Xinya extends FrontendController
{
    public function ruhuitehui()
    {
        $weixin = new WeixinUtil();
        $weixin->refreshAccessToken();
    }


}