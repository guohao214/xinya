<link rel="stylesheet"
      href="<?php echo get_instance()->config->base_url(); ?>static/frontend/css/coupon.css?v=20160301">
<script type="text/javascript"
        src="<?php echo get_instance()->config->base_url(); ?>static/frontend/js/get-coupon.js?v=20160301"></script>
<header>
    <a class="prev j_prePage" href="<?php echo UrlUtil::createUrl('userCenter/index');?>"></a>
    <h2>积分兑换</h2>
</header>
<section>
    <div class="tab_wrap">
        <ul class="tabs j_scroll" id="iScroll0" style="">
            <li class="current">
                <a href="<?php echo UrlUtil::createUrl("exchange/coupon"); ?>"><i></i>兑换优惠券</a>
            </li>
            <li class="">
                <a href="<?php echo UrlUtil::createUrl("exchange/exchangeGoods"); ?>"><i></i>兑换商品</a>
            </li>
        </ul>
    </div>
    <?php if ($coupons): ?>
        <?php foreach ($coupons as $coupon): ?>
            <div class="stamp stamp01">
                <div class="par">
                    <p class="coupon-title">
                        <?php echo $coupon['coupon_name']; ?>
                    </p>
            <span>
                ￥ <?php echo $coupon['counteract_amount']; ?>
            </span>
                    <p class="use-rule">
                        【订单满<?php echo $coupon['use_rule']; ?>元 可用】
                    </p>
                    <p class="use-time">
                        <?php echo $coupon['start_time']; ?> 至 <?php echo $coupon['expire_time']; ?>
                    </p>
                    <p class="get-coupon">
                        <span class="do-get-coupon" data-id="<?php echo $coupon['coupon_id']; ?>">兑换</span>【需要<?php echo $coupon['exchange_credits']; ?> 积分】
                    </p>
                </div>

            </div>

        <?php endforeach; ?>
    <?php else: ?>
        <div class="result-wrap">
            <div class="result-content">
                <div class="tips F14">
                    <img src="<?php echo get_instance()->config->base_url(); ?>static/frontend/images/warning.png">
                    <br>
                    <br>
                    暂无可兑换的优惠券
                </div>
            </div>
        </div>
    <?php endif; ?>

</section>