<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 2016/1/19
 * Time: 22:53
 */
class WorkTimeUtil
{
    public $configFile = 'work-time';
    public $beauticianWorkTimeConfigFile = 'beautician_work_time';
    public $workTime = '';
    public $beauticianWorkTime = '';

    public function __construct()
    {
        $this->getTime();
        $this->getBeauticianWorkTime();
    }

    public function build($start, $end)
    {
        $start = trim($start);
        $end = trim($end);

        return "{$start}-{$end}";
    }

    /**
     * 设置工作时间
     * @param $allDay
     * @param $morningShift
     * @param $middayShift
     * @param $nightShift
     * @return bool
     */
    public function saveWorkTime($allDay, $morningShift, $nightShift, $middayShift)
    {
        $time = array(
            'allDay' => $allDay,
            'morningShift' => $morningShift,
            'middayShift' => $middayShift,
            'nightShift' => $nightShift,
        );

        $configPath = ConfigUtil::getConfigPath($this->configFile);
        $content = "<?php\nreturn " . var_export($time, true) . ";\n?>";
        return file_put_contents($configPath, $content);
    }

    public function getTime()
    {
        $workTime = ConfigUtil::loadConfig($this->configFile);
        if (is_array($workTime))
            $this->workTime = $workTime;
    }

    public function getBeauticianWorkTime()
    {
        $workTime = ConfigUtil::loadConfig($this->beauticianWorkTimeConfigFile);
        if (is_array($workTime))
            $this->beauticianWorkTime = $workTime;
    }

    public function explode($time)
    {
        $explodeTime = explode('-', $time);
        return array(trim($explodeTime[0]), trim($explodeTime[1]));
    }

    public function getAllDay()
    {
        return $this->workTime['allDay'];
    }

    public function getMorningShift()
    {
        return $this->workTime['morningShift'];
    }

    public function getNightShift()
    {
        return $this->workTime['nightShift'];
    }


    public function getMiddayShift()
    {
        return $this->workTime['middayShift'];
    }
}