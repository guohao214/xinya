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
     * 展示预约页面
     * 选择美容师与预约时间
     * 此处要验证授权
     *
     * @param $shopId 店铺ID
     */
    public function index($shopId)
    {
        // 验证是否已授权
        (new WeixinUtil())->authorize("appointment/index/{$shopId}");

        // 获得预约项目
        $projectId = (new CartUtil())->cart();
        $projectId += 0;
        if (!$projectId)
            $this->message('预约项目不存在！');

        //是否已经选择了店铺，并且店铺是有效的
        $shops = (new ShopModel())->getAllShops();
        if (is_numeric($shopId) && array_key_exists($shopId, $shops)) {
            // 获得项目信息
            $project = (new ProjectModel())->readOne($projectId);
            if (!$project)
                $this->message('预约项目不存在！');

            // 跳转到 选择 美容师
            $beauticians = (new BeauticianModel())->getAllBeauticians();
            $days = DateUtil::buildDays();
            $this->load->view('frontend/appointment/beautician',
                array('beauticians' => $beauticians, 'project' => $project, 'shopId' => $shopId, 'days' => $days));
        } else {
            // 跳转到选择店铺
            $returnUrl = urlencode(UrlUtil::createUrl('appointment/index'));
            ResponseUtil::redirect(UrlUtil::createUrl("shop/index?returnUrl={$returnUrl}"));
        }

    }

    /**
     * 获得有效的预约时间
     * 首先查询 指定日期 美容师休息表， 获得休息时间
     * 再查询 指定日期 美容师 已接受预定的 时间
     *
     * @param $beautician_id 美容师ID
     * @param $day 查询日期
     */
    public function getValidAppointmentTime($beautician_id, $day)
    {
        if (!$beautician_id || !$day)
            ResponseUtil::failure('参数错误!');

        $today = date('Y-m-d');
        if ($day < $today)
            ResponseUtil::failure('错误的预约时间！');

        // 查询休息时间
        $beauticianRest = (new CurdUtil(new BeauticianRestModel()))
            ->readOne(
                array('beautician_id' => $beautician_id,
                    'disabled' => 0,
                    'rest_day' => $day), 'beautician_rest_id desc');

        // 指定日期的所有预约时间段
        $appointmentTimes = DateUtil::generateAppointmentTime($day, '11:00:00', '19:00:00');

        // 美容师制定日期休息时间段
        // 当值为0时， 说明不能预约
        if ($beauticianRest) {
            $beauticianRestAppointmentTimes = DateUtil::generateAppointmentTime($day,
                $beauticianRest['start_time'], $beauticianRest['end_time']);

            foreach ($appointmentTimes as $k => $time) {
                if (array_key_exists($k, $beauticianRestAppointmentTimes))
                    $appointmentTimes[$k] = 0;
            }
        }

        // 获得制定日期已经预约的时间段，订单状态为已支付
        $payedOrders = (new OrderModel())->getOrderByBeauticianIdAndAppointmentDay($beautician_id, $day);
        if ($payedOrders) {
            foreach ($payedOrders as $payedOrder) {
                $orderAppointmentTime = DateUtil::generateAppointmentTime($payedOrder['appointment_day'],
                    $payedOrder['appointment_start_time'], $payedOrder['appointment_end_time']);

                foreach ($appointmentTimes as $k => $time) {
                    if (array_key_exists($k, $orderAppointmentTime))
                        $appointmentTimes[$k] = 0;
                }
            }
        }

        // 小于当前时间不能预约
        if ($today == $day) {
            $now = date('H:i');
            foreach ($appointmentTimes as $k => $time) {
                if ($k < $now)
                    $appointmentTimes[$k] = 0;
            }
        }
        // 渲染视图
        $render = $this->load->view('frontend/appointment/appointmentTimes',
            array('appointmentTimes' => $appointmentTimes), true);

        ResponseUtil::executeSuccess('成功', $render);
    }
}