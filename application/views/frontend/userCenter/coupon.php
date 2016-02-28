<link rel="stylesheet"
      href="<?php echo get_instance()->config->base_url(); ?>static/frontend/css/coupon.css">

<header>
    <h2>已兑换优惠券</h2>
</header>
<section>
    <?php if ($coupons): ?>
        <?php foreach ($coupons as $coupon): ?>
            <div class="stamp stamp01 stamp-user">
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
                        <?php if ($coupon['is_use'] == 1): ?>
                        已使用
                        <?php elseif (date('Y-m-d') > $coupon['expire_time']): ?>
                        已过期
                        <?php else: ?>
                        <?php echo $coupon['start_time']; ?> 至 <?php echo $coupon['expire_time']; ?>
                    <?php endif; ?>
                    </p>

                </div>
            </div>

        <?php endforeach; ?>
            <div class="list-page"><?php echo $pages; ?></div>
    <?php else: ?>
        <div class="result-wrap">
            <div class="result-content">
                <div class="tips F14">
                    <img src="<?php echo get_instance()->config->base_url(); ?>static/frontend/images/warning.png">
                    <br>
                    <br>
                    暂无已兑换的优惠券
                </div>
            </div>
        </div>
    <?php endif; ?>

</section>