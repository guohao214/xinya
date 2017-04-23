<?php

/**
 * 创客
 * User: GuoHao
 * Date: 2017/4/3
 * Time: 11:02
 */
class Makers extends FrontendController
{
    public $openId = '';

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->pageTitle = '创客管理';
        $wechat = new WeixinUtil();
        $this->openId = $wechat->getOpenId();

        if (!$this->openId)
            $wechat->authorize("makers/index");

        $openId = $this->openId;
        $customer = (new CustomerModel())->readOne($openId);
        if (!$customer)
            show_error('查询失败，请重试');

        $makerOrderModel = new MakerOrderModel();
        $group = $makerOrderModel->group($openId);  // 汇总
        if ($group && $group[0])
            $group = array_shift($group);
        else
            $group = ['all_amount' => 0.00, 'all_buyer' => 0, 'all_earnings_percent' => 0.00];

        $this->view('makers/index',
            array('customer' => $customer, 'group' => $group));
    }

    public function customer($offset = 0)
    {
        $openId = $this->openId;

        $customerData = (new MakerOrderModel())->getCustomers($openId, $offset);
        $pages = (new PaginationUtil($customerData['count'], 'user_center'))->pagination();

        $this->view('makers/customer',
            array('pages' => $pages, 'customers' => $customerData['customers']));
    }

    /**
     * 提现记录
     */
    public function withdrawDeposit()
    {
        $withdrawDepositList = (new WithdrawDepositModel())->getList($this->openId);

        $this->view('makers/withdraw_deposit',
            array('withdrawDeposits' => $withdrawDepositList));
    }

    /**
     * 提现申请
     */
    public function applyWithdrawDeposit()
    {
        $openId = $this->openId;

        $makerOrderModel = new MakerOrderModel();
        $amount = $makerOrderModel->getWithdrawDepositAmount($openId);

        $withdrawDepositAccountModel = new WithdrawDepositAccountModel();

        if (RequestUtil::isAjax()) {
            $params = RequestUtil::getParams();
            $dpaId = $params['dpa_id'] + 0;
            if ($dpaId == 0)
                ResponseUtil::failure('请选择提现账号');

            $dpaAccount = $withdrawDepositAccountModel->readOne($openId, $dpaId);
            if (!$dpaAccount)
                ResponseUtil::failure('查询提现账号失败');

            // 判断提现金额
            if ($amount < 30)
                ResponseUtil::failure('提现金额小于100， 不能提现');

            // 插入提现记录
            $data = array(
                'open_id' => $openId,
                'dp_amount' => $amount,
                'dp_account' => $dpaAccount['dpa_account'],
                'dp_account_type' => $dpaAccount['dpa_account_type'],
                'create_time' => DateUtil::now()
            );


            $this->db->trans_start();
            $mkDpId = (new WithdrawDepositModel())->create($data);
            if ($mkDpId) {
                // 更新记录
                (new MakerOrderModel())->setWithdrawDepositId($openId, $mkDpId);
            } else {
                ResponseUtil::failure('提现失败，请重试');
            }

            // 事物完成
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                ResponseUtil::failure('提现失败，请重试');
            } else {
                $this->db->trans_commit();
                ResponseUtil::executeSuccess('提现成功', UrlUtil::createUrl('makers/withdrawDeposit'));
            }

            exit;
        }

        $withdrawDepositAccounts = $withdrawDepositAccountModel->getList($openId);
        // 获得提现金额
        $this->view('makers/apply_withdraw_deposit',
            array('amount' => $amount, 'withdrawDepositAccounts' => $withdrawDepositAccounts));
    }

    /**
     * 提现账号
     */
    public function withdrawDepositAccount()
    {
        $accountList = (new WithdrawDepositAccountModel())->getList($this->openId);
        $this->view('makers/withdraw_deposit_account',
            array('accountList' => $accountList));
    }

    /**
     * 我的收入
     * @param $offset
     */
    public function earning($offset = 0)
    {
        $earninies = (new MakerOrderModel())->getEarning($this->openId, $offset);
        $pages = (new PaginationUtil($earninies['count'], 'user_center'))->pagination();
        $this->view('makers/earning',
            array('pages' => $pages, 'earninies' => $earninies['customers']));
    }

    /**
     * @param $firstStage  第一级分享
     * @param string $secondStage 第二级分享
     * @param string $buyerOpenId
     */
    public function share($firstStage, $secondStage = '', $buyerOpenId = '')
    {
        $openId = $this->openId;

        $shareForm = array($firstStage, $secondStage, $buyerOpenId);
        array_walk($shareForm, function (&$item) {
            if ($item)
                $item = EncryptUtil::decrypt($item);
        });

        $shareForm[] = $openId;
        $shareForm = array_filter(array_unique($shareForm));

        $count = (new CustomerModel())->findCustomer($shareForm);
        if ($count != count($shareForm))
            show_error('来源用户不存在');

        if (count($shareForm) > 3)
            array_shift($shareForm);

        ShareUtil::setShareFrom($shareForm);

        // 返回到首页
        ResponseUtil::redirect(UrlUtil::createUrl('project/index'));
    }

    /**
     * 收款账号
     */
    public function applyWithdrawDepositAccount() {
        $openId = $this->openId;
        $params = RequestUtil::getParams();

        $data['open_id'] = $openId;
        $data['dpa_account_type'] = $params['accountType'];
        $data['dpa_account'] = $params['accountNumber'];
        $data['create_time'] = DateUtil::now();

        if ((new CurdUtil((new WithdrawDepositAccountModel())))->create($data))
            ResponseUtil::executeSuccess('增加提现账号成功');
        else
            ResponseUtil::failure('增加提现账号失败');

    }

    public function deleteWithdrawDepositAccount() {
        $params = RequestUtil::getParams();

        $id = $params['id'] + 0;
        $data['open_id'] = $this->openId;
        $data['mk_dpa_id'] = $id;

        if ((new CurdUtil((new WithdrawDepositAccountModel())))->update($data, array('disabled' => 1)))
            ResponseUtil::executeSuccess('删除提现账号成功');
        else
            ResponseUtil::failure('删除提现账号失败');
    }

    public function myShareQrCode()
    {
        $shareUrl = ShareUtil::getShareUrl();
        $customer = (new CustomerModel())->readOne($this->openId);
        
        $this->view('makers/shareQrCode', array(
            'shareUrl' => $shareUrl,
            'customerName' => $customer['nick_name']
        ));
    }
}