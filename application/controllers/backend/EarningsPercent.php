<?php
class EarningsPercent extends BackendController
{
    /**
     * 设置提成
     */
    public function index()
    {
        if (RequestUtil::isPost()) {
            $params = RequestUtil::postParams();

            // amount
            $data = [];
            $amounts = $params['amount'];
            $percents = $params['percent'];
            $percents1 = $params['percent1'];

            foreach ($amounts as $key => $amount) {
                if ($amount==0 || $amount == '')
                    continue;

                if ($percents[$key] == '' || $percents[$key] == 0)
                    continue;

                $data[$amount] = array(
                    number_format($percents[$key] / 100, 3),
                    number_format($percents1[$key] / 100, 3),
                );
            }

            EarningsPercentUtil::saveEarningsPercent($data);

        }


        $earningPercent = EarningsPercentUtil::getList();
        $this->view('earningsPercent/index', array('earningPercent' => $earningPercent));
    }

    public function deleteEarningPercent($amount)
    {
        if (!$amount)
            $this->message('发生错误了！');

        $earningPercent = EarningsPercentUtil::getList();
        foreach ($earningPercent as $fee => $percent) {
            if ($fee == $amount)
                $earningPercent[$fee] = 0;
        }

        // 保存
        EarningsPercentUtil::saveEarningsPercent($earningPercent);
        $this->message('删除成功！', "earningsPercent/index");

    }

}