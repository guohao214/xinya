<?php

/**
 * 优惠券管理
 * User: GuoHao
 * Date: 15-12-14
 * Time: 下午10:52
 */
class Coupon extends BackendController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('CouponModel', 'couponModel');
    }

    public function index($limit = '')
    {
        $where = RequestUtil::buildLikeQueryParamsWithDisabled();
        $coupons = (new CurdUtil($this->couponModel))->readLimit($where, $limit, 'coupon_id desc');
        $couponsCount = (new CurdUtil($this->couponModel))->count($where);
        $pages = (new PaginationUtil($couponsCount))->pagination();

        $this->view('coupon/index', array('coupons' => $coupons, 'limit' => $limit + 0,
            'pages' => $pages, 'params' => RequestUtil::getParams()));
    }

    /**
     * 新增优惠券
     */
    public function addCoupon()
    {
        if (RequestUtil::isPost()) {
            if ($this->couponModel->rules()->run()) {
                $params = RequestUtil::postParams();
                $params['remain_number'] = $params['total_number'];
                $insertId = (new CurdUtil($this->couponModel))
                    ->create(array_merge($params, array('create_time' => DateUtil::now())));

                if ($insertId)
                    $this->message('新增优惠券成功!', 'coupon/index');
                else
                    $this->message('新增优惠券失败!', 'coupon/index');
            }
        }

        $this->view('coupon/addCoupon');
    }

    public function updateCoupon($couponId, $limit='')
    {
        if (!$couponId)
            $this->message('优惠券不能为空！');

        if (RequestUtil::isPost()) {
            if ($this->couponModel->rules()->run()) {
                $params = RequestUtil::postParams();

                if ((new CurdUtil($this->couponModel))->update(array('coupon_id' => $couponId), $params))
                    $this->message('修改优惠券成功!', 'coupon/updateCoupon/' . $couponId ."/{$limit}");
                else
                    $this->message('修改优惠券失败!', 'coupon/updateCoupon/' . $couponId ."/{$limit}");
            }
        }

        $coupon = $this->couponModel->readOne($couponId);
        $this->view('coupon/updateCoupon', array('coupon' => $coupon, 'limit' => $limit));
    }


    public function deleteCoupon($couponId, $limit = 0)
    {
        if (!$couponId)
            $this->message('优惠券不能为空！');

        if ((new CurdUtil($this->couponModel))->update(array('coupon_id' => $couponId), array('disabled' => 1)))
            $this->message('删除优惠券成功！', "coupon/index/{$limit}");
        else
            $this->message('删除优惠券失败！', "coupon/index/{$limit}");
    }
} 