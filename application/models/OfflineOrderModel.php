<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 2016/3/3
 * Time: 22:38
 */
class OfflineOrderModel extends BaseModel
{
    const ORDER_WAIT = '待服务';
    const ORDER_SERVICED = '已服务';

    public function setTable()
    {
        $this->table = 'offline_order';
    }

    /**
     * 获得线下预约情况
     * @param $beauticianId
     * @param $appointmentDay
     */
    public function getOrderByBeauticianIdAndAppointmentDay($beauticianId, $appointmentDay)
    {
        $where = array('beautician_id' => $beauticianId, 'appointment_day' => $appointmentDay,
            'disabled' => 0, 'order_status' => OfflineOrderModel::ORDER_WAIT);

        return (new CurdUtil($this))->readAll('offline_order_id desc', $where);
    }

}