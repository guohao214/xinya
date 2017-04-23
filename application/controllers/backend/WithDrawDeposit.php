<?php

/**
 * 提现管理
 */
class WithDrawDeposit extends BackendController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('WithdrawDepositModel', 'withdrawDepositModel');
    }

    public function index($limit = 0)
    {
        $withDrawDeposits = $this->withdrawDepositModel->getListWithCustomer($limit);
        $pages = (new PaginationUtil($withDrawDeposits['count']))->pagination();
        $this->view('withDrawDeposit/index',
            array('withDrawDeposits' => $withDrawDeposits['rows'], 'pages' => $pages,
                'params' => RequestUtil::getParams(), 'limit' => $limit));
    }

    public function pass($id, $limit = 0)
    {
        if (!$id)
            $this->message('ID不能为空！');

        if ((new CurdUtil($this->withdrawDepositModel))->update(array('mk_dp_id' => $id),
            array('status' => 2)))
            $this->message('操作成功！', 'withDrawDeposit/index/' . $limit);
        else
            $this->message('操作失败！', 'withDrawDeposit/index/' . $limit);
    }

    public function reject($id)
    {
        if (!$id)
            $this->message('ID不能为空！');

        $params = RequestUtil::getParams();
        $reason = $params['reason'];

        if ((new CurdUtil($this->withdrawDepositModel))->update(array('mk_dp_id' => $id),
            array('status' => 1, 'reject_reason' => $reason)))
            ResponseUtil::executeSuccess('操作成功');
        else
            ResponseUtil::failure('操作失败');
    }
}