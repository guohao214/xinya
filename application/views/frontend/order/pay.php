<header>
    <h2>订单支付</h2>
</header>

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
                <p>门店:<span class="F14"><?php echo $shop; ?></span></p>
                <strong class="FN colorH">预约时间: <?php echo $order['appointment_day'];?><br>
                        <?php echo $order['appointment_start_time'] . ' 至 ' . $order['appointment_end_time'] ; ?></b></strong>
                <strong class="add FN colorH">美容师:<?php echo $order['beautician_name']; ?></strong>
                <i class="order_list_i"> </i>
            </div>
            </dt>
            <dd>
                <a class="colorW" onclick="pay()">马上支付</a>
                <i class="colorH">总金额:<strong class="F18 colorR">￥<?php echo number_format($order['total_fee'], 2); ?></strong></i>
                <P><samp class="colorH">支付状态：</samp>未支付</P>
                <P><samp class="colorH">下单时间：</samp><?php echo $order['create_time']; ?></P>
            </dd>
        </dl>

    </div>
</section>

<script type="text/javascript">
    function weixin_pay() {
        WeixinJSBridge.invoke(
            'getBrandWCPayRequest',
            <?php echo $payParams; ?>,
            function (res) {
                if (res.err_msg == 'get_brand_wcpay_request:ok') {
                    window.location.href = "<?php echo UrlUtil::createUrl('userCenter/order'); ?>";
                } else if (res.err_msg == 'get_brand_wcpay_request:cancel') {
                    alert('取消支付');
                } else if (res.err_msg == 'get_brand_wcpay_request:fail') {
                    alert('支付失败');
                } else {
                    return false;
                }
            }
        );
    }

    function pay() {
        if (typeof WeixinJSBridge == "undefined") {
            if (document.addEventListener) {
                document.addEventListener('WeixinJSBridgeReady', weixin_pay, false);
            } else if (document.attachEvent) {
                document.attachEvent('WeixinJSBridgeReady', weixin_pay);
                document.attachEvent('onWeixinJSBridgeReady', weixin_pay);
            }
        } else {
            weixin_pay();
        }
    }
</script>
