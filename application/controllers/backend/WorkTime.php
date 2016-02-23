<?php

/**
 * 工作时间设置
 * User: GuoHao
 * Date: 2016/1/19
 * Time: 23:30
 */
class WorkTime extends BackendController
{
    public function index()
    {
        $workTime = new WorkTimeUtil();


        if (RequestUtil::isPost()) {
            $params = RequestUtil::postParams();
            $params = array_map(function($time) {
                if (!preg_match("~^\d{2}:\d{2}:\d{2}$~", $time))
                    return "{$time}:00";
                else
                    return $time;
            }, $params);

            $allDay = $workTime->build($params['allDayStart'], $params['allDayEnd']);
            $morningShift = $workTime->build($params['morningShiftStart'], $params['morningShiftEnd']);
            $middayShift = $workTime->build($params['middayShiftStart'], $params['middayShiftEnd']);
            $nightShift = $workTime->build($params['nightShiftStart'], $params['nightShiftEnd']);

            $workTime->saveWorkTime($allDay, $morningShift, $nightShift, $middayShift);
            $workTime->getTime();
        }

        list($allDayStart, $allDayEnd) = $workTime->explode($workTime->getAllDay());
        list($morningShiftStart, $morningShiftEnd) = $workTime->explode($workTime->getMorningShift());
        list($middayShiftStart, $middayShiftEnd) = $workTime->explode($workTime->getMiddayShift());
        list($nightShiftStart, $nightShiftEnd) = $workTime->explode($workTime->getNightShift());

        $setting = array(
            'allDayStart' => $allDayStart,
            'allDayEnd' => $allDayEnd,
            'morningShiftStart' => $morningShiftStart,
            'morningShiftEnd' => $morningShiftEnd,
            'nightShiftStart' => $nightShiftStart,
            'nightShiftEnd' => $nightShiftEnd,
            'middayShiftStart' => $middayShiftStart,
            'middayShiftEnd' => $middayShiftEnd
        );

        $this->view('workTimeSetting', array('setting' => $setting));
    }
}