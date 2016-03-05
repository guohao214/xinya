<?php

/**
 * 线下预约
 * User: GuoHao
 * Date: 2016/3/3
 * Time: 20:32
 */
class OfflineAppointment extends BackendController
{
    public function index($projectId)
    {

        $project = (new ProjectModel())->readOne($projectId + 0);
        if (!$project)
            $this->message('项目不存在！');

        $shops = (new ShopModel())->getAllShops();
        $beauticians = (new BeauticianModel())->getAllBeauticians();
        $days = DateUtil::buildDays();

        $this->view('offline/appointment',
            array('beauticians' => $beauticians, 'shops' => $shops, 'days' => $days, 'project' => $project));
    }

    public function appointment()
    {
        $params = RequestUtil::postParams();

        $userName = urldecode($params['user_name']);
        if (empty($userName))
            $this->message('联系人不能为空！');

        $phoneNumber = $params['phone_number'];
        if (empty($phoneNumber))
            $this->message('手机号不能为空！');

        $appointmentDay = $params['appointment_day'];
        $appointmentTime = $params['appointment_times'];
        $today = date('Y-m-d');
        if ($appointmentDay < $today)
            $this->message('错误的预约日期！');

        // 检查时间
        $appointmentTime = explode(',', urldecode($appointmentTime));
        if (!$appointmentTime || count($appointmentTime) < 1)
            $this->message('错误的预约时间！');

        // 只有30分钟的项目
        if (count($appointmentTime) == 1)
            array_push($appointmentTime, $appointmentTime[0]);

        // 只保留头和尾的两个数据
        $startTime = array_shift($appointmentTime);
        $endTime = array_pop($appointmentTime);
        if ($endTime < $startTime)
            $this->message('错误的预约时间！');

        // 预约时间是否小于当前时间
        $now = date('Y-m-d H:i');
        if (DateUtil::buildDateTime($appointmentDay, $startTime) < $now)
            $this->message('错误的预约开始时间！');

        if (DateUtil::buildDateTime($appointmentDay, $endTime) < $now)
            $this->message('错误的预约结束时间！');

        $beauticianId = $params['beautician_id'];
        // 判断相同的时间是否已经被预约
        $findHasPayedAppointTimeWhere = array('appointment_day' => $appointmentDay,
            'appointment_start_time' => $startTime, 'order_status' => OrderModel::ORDER_PAYED, 'beautician_id' => $beauticianId);
        $findOrder = (new CurdUtil(new OrderModel()))->readOne($findHasPayedAppointTimeWhere);
        if ($findOrder)
            $this->message('此时间段已被预约!');

        unset($findOrder);
        $findHasPayedAppointTimeWhere['order_status'] = OfflineOrderModel::ORDER_WAIT;
        $findOrder = (new CurdUtil(new OfflineOrderModel()))->readOne($findHasPayedAppointTimeWhere);
        if ($findOrder)
            $this->message('此时间段已被预约!');

        // 没有问题
        $data = array(
            'project_id' => $params['project_id'],
            'project_name' => $params['project_name'],
            'use_time' => $params['use_time'],
            'shop_id' => $params['shop_id'],
            'beautician_id' => $beauticianId,
            'appointment_day' => $appointmentDay,
            'appointment_start_time' => $startTime,
            'appointment_end_time' => $endTime,
            'user_name' => $userName,
            'phone_number' => $phoneNumber,
            'create_time' => DateUtil::now()
        );

        if ((new CurdUtil(new OfflineOrderModel()))->create($data))
            $this->message('线下预约成功！', 'offlineOrder/index');
        else
            $this->message('线下预约失败！');
    }
}