<header>
    <h2>订单支付</h2>
</header>

<section>
    <div class="order">
        <dl class="order_list">
            <dd>
                <div></div>
                <samp class="order_number">订单：<span class="F14">
                        <?php echo $orderNo; ?>
                    </span></samp>
            </dd>
            <dt>
                <?php foreach ($orders as $order): ?>
            <div class="order_list_dtDiv">
                <a>
                    <img
                        src="<?php echo UploadUtil::buildUploadDocPath($order['project_cover'], '100x100'); ?>">
                </a>

                <a>
                    <h3 class="F14 FN"><?php echo $order['project_name']; ?></h3>
                </a>
                <strong class="FN colorH">价格:<b class="F14">￥<?php echo $order['total_fee']; ?></b></strong>
                <p></p>
                <strong class="add FN colorH">金额:<b class="F14">￥
                        <?php echo number_format($order['buy_counts'] * $order['total_fee'], 2); ?></b></strong>
                <i class="order_list_i">
                    <samp class="colorW count_ON">
                        数量：<?php echo $order['buy_counts']; ?>
                    </samp>
                </i>
            </div>
            <?php endforeach; ?>
            </dt>
            <dd>
                <a class="colorW" onclick="pay()">马上支付</a>
                <i class="colorH">总金额:<strong class="F18 colorR">￥<?php echo number_format($totalAmount, 2); ?></strong></i>
                <P><samp class="colorH">支付状态：</samp>未支付</P>
            </dd>
        </dl>

    </div>
</section>

<script type="text/javascript">
    function weixin_pay() {
        WeixinJSBridge.invoke(
            'getBrandWCPayRequest',
            <?php echo $params; ?>,
            function (res) {
                alert(res.err_msg);
                if (res.err_msg == 'get_brand_wcpay_request:ok') {
                    // 支付返回
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
