<?php

/**
 * 时间工具
 * User: GuoHao
 * Date: 15-12-16
 * Time: 下午11:43
 */
class DateUtil
{
    /**
     * 获得当前时间
     * @return bool|string
     */
    public static function now()
    {
        return date('Y-m-d H:i:s');
    }

    /**
     * 检查两个时间差
     * @param $date
     * @param $subDate
     * @param string $now
     * @return bool
     */
    public static function orderIsValidDate($date, $subDate = 2, $now = '')
    {
        if (!$now)
            $now = time();

        if (!is_numeric($date))
            $date = strtotime($date);

        $sub = ($now - $date);
        return ($sub < $subDate * 86400);
    }

    /**
     * 生成预约时间数组
     * @param $day
     * @param $startTime
     * @param $endTime
     * @return array
     */
    public static function generateAppointmentTime($day, $startTime, $endTime)
    {

        $startTimeStamp = strtotime($day . ' ' . $startTime);
        $endTimeStamp = strtotime($day . ' ' . $endTime);

        $sub = $endTimeStamp - $startTimeStamp;

        $times = $sub / 1800;

        $appointmentTimes = array();

        for ($i = 0; $i <= $times; $i++) {
            $appointmentTimes[date('H:i', $startTimeStamp + ($i * 1800))] = 1;
        }

        return $appointmentTimes;
    }

    /**
     * 日期+时间
     * @param $day
     * @param $time
     * @return string
     */
    public static function buildDateTime($day, $time)
    {
        return "{$day} {$time}";
    }

    /**
     * 生成制定日期后的 {$count}天
     * @param string $day
     * @param int $count
     * @return array
     */
    public static function buildDays($day = '', $count = 15)
    {
        if (!$day)
            $day = date('Y-m-d');

        $days = array();
        // 0（表示星期天）到 6（表示星期六）
        $weeks = array(0 => '星期天', 1 => '星期一', 2 => '星期二', 3 => '星期三', 4 => '星期四', 5 => '星期五', 6 => '星期六');
        for ($i = 0; $i < $count; $i++) {
            $date = date('Y-m-d', strtotime("{$day} +{$i} day"));
            // 星期
            $week = $weeks[date('w', strtotime($date))];

            $days[$date] = "{$date} {$week}";
        }

        return $days;
    }
} 