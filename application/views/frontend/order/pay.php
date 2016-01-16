<header>
    <h2>订单支付(请在10分钟之内支付)</h2>
</header>

<input type="hidden" name="pay-params" value="<?php echo urlencode($payParams); ?>">
<input type="hidden" name="pay-redirect-url" value="<?php echo UrlUtil::createUrl('userCenter/order'); ?>">

<section>
    <div class="order">
        <dl class="order_list">
            <dd>
                <div></div>
                <samp class="order_number">订单：<span class="F14">
                        <?php echo $order['order_no']; ?>
                    </span></samp>
            </dd>
            <dt>
            <div class="order_list_dtDiv">
                <a>
                    <img
                        src="<?php echo UploadUtil::buildUploadDocPath($order['project_cover'], '100x100'); ?>">
                </a>

                <a>
                    <h3 class="F14 FN"><?php echo $order['project_name']; ?></h3>
                </a>
                <p>门店:<span class="F11"><?php echo $shop; ?></span></p>
                <strong
                    class="FN colorH">预约时间: <?php echo DateUtil::buildDateTime($order['appointment_day'], $order['appointment_start_time']); ?></strong>
                <strong class="add FN colorH">美容师:<?php echo $order['beautician_name']; ?></strong>
                <i class="order_list_i"> </i>
            </div>
            </dt>
            <dd>
                <a class="colorW pay-click">马上支付</a>
                <i class="colorH">总金额:<strong
                        class="F18 colorR">￥<?php echo number_format($order['total_fee'], 2); ?></strong></i>
                <P><samp class="colorH">支付状态：</samp>未支付</P>
                <P><samp class="colorH">下单时间：</samp><?php echo $order['create_time']; ?></P>
            </dd>
        </dl>

    </div>
</section>

<script type="text/javascript"
        src="<?php echo get_instance()->config->base_url(); ?>static/frontend/js/pay.js"></script>
</script>