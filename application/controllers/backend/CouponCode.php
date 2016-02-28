<?php

/**
 * 优惠码管理
 * User: GuoHao
 * Date: 15-12-14
 * Time: 下午10:52
 */
class CouponCode extends BackendController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('CouponCodeModel', 'couponCodeModel');
    }

    public function index($limit = '')
    {
        $where = RequestUtil::buildLikeQueryParamsWithDisabled();
        $couponCodes = (new CurdUtil($this->couponCodeModel))->readLimit($where, $limit, 'coupon_code_id desc');
        $couponCodesCount = (new CurdUtil($this->couponCodeModel))->count($where);
        $pages = (new PaginationUtil($couponCodesCount))->pagination();

        $this->view('couponCode/index', array('coupons' => $couponCodes, 'limit' => $limit + 0,
            'pages' => $pages, 'params' => RequestUtil::getParams()));
    }

    /**
     * 新增优惠码
     */
    public function addCouponCode()
    {
        if (RequestUtil::isPost()) {
            if ($this->couponCodeModel->rules()->run()) {
                $params = RequestUtil::postParams();
                $insertId = (new CurdUtil($this->couponCodeModel))
                    ->create(array_merge($params, array('create_time' => DateUtil::now())));

                if ($insertId)
                    $this->message('新增优惠码成功!', 'couponCode/index');
                else
                    $this->message('新增优惠码失败!', 'couponCode/index');
            }
        }

        $this->view('couponCode/addCouponCode');
    }

    public function updateCouponCode($couponCodeId, $limit='')
    {
        if (!$couponCodeId)
            $this->message('优惠码不能为空！');

        if (RequestUtil::isPost()) {
            if ($this->couponCodeModel->rules()->run()) {
                $params = RequestUtil::postParams();

                if ((new CurdUtil($this->couponCodeModel))->update(array('coupon_code_id' => $couponCodeId), $params))
                    $this->message('修改优惠码成功!', 'couponCode/updateCouponCode/' . $couponCodeId ."/{$limit}");
                else
                    $this->message('修改优惠码失败!', 'couponCode/updateCouponCode/' . $couponCodeId ."/{$limit}");
            }
        }

        $coupon = $this->couponCodeModel->readOne($couponCodeId);
        $this->view('couponCode/updateCouponCode', array('coupon' => $coupon, 'limit' => $limit));
    }


    public function deleteCouponCode($couponCodeId, $limit = 0)
    {
        if (!$couponCodeId)
            $this->message('优惠码不能为空！');

        if ((new CurdUtil($this->couponCodeModel))->update(array('coupon_code_id' => $couponCodeId), array('disabled' => 1)))
            $this->message('删除优惠码成功！', "couponCode/index/{$limit}");
        else
            $this->message('删除优惠码失败！', "couponCode/index/{$limit}");
    }
} 