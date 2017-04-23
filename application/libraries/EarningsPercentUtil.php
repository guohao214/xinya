<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 2017/4/16
 * Time: 21:41
 */
class EarningsPercentUtil
{
    const CONFIG_FILE_NAME = 'earnings_percent';

    public static function getList() {
        $earningsPercents = ConfigUtil::loadConfig(self::CONFIG_FILE_NAME);

        if (is_array($earningsPercents))
            ksort($earningsPercents);
        else
            $earningsPercents = [];

        return $earningsPercents;
    }

    public static function getPercent($amount)
    {

        $earningsPercents = self::getList();

        $percent = 0;

        foreach ($earningsPercents as $key => $item) {
            if ($key <= $amount)
                $percent = $item;
        }

        if ($percent == 0) {
            $percent = array_shift($earningsPercents);
        }

        return $percent;

    }

    public static function saveEarningsPercent($data)
    {
        // 去除无效的
        $data = array_filter($data);
        $fileName = ConfigUtil::getConfigPath(self::CONFIG_FILE_NAME);

        file_put_contents($fileName, "<?php \nreturn " . var_export($data, true) . ";?>");
    }
}