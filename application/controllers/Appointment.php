<?php

/**
 * 预约
 * User: GuoHao
 * Date: 2016/1/10
 * Time: 14:18
 */
class Appointment extends FrontendController
{
    /**
     * 检测是否已授权
     */
    public function index()
    {
        // 验证是否已授权
        //(new WeixinUtil())->authorize('appointment/index');

        //是否已经选择了店铺
        $shopId = $this->input->get('shop_id', true);
        $shops = (new ShopModel())->getAllShops();
        if (is_numeric($shopId) && array_key_exists($shopId, $shops)) {
            // 跳转到 选择 美容师
            $beauticians = (new BeauticianModel())->getAllBeauticians();
            $this->load->view('frontend/appointment/beautician', array('beauticians' => $beauticians));
        } else {
            // 跳转到选择店铺
        }

    }
}