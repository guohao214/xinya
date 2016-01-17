<header>
    <a class="prev j_prePage" href="<?php echo UrlUtil::createUrl('project/index'); ?>"></a>
    <h2>我的订单</h2>
</header>

<section>
    <div class="tab_wrap">
        <ul class="tabs j_scroll" id="iScroll0" style="">
            <li class="<?php echo (empty($orderStatus)) ? 'current' : ''; ?>">
                <a href="<?php echo UrlUtil::createUrl("userCenter/order/0"); ?>"><i></i>全部</a>
            </li>
            <li class="<?php echo ($orderStatus == OrderModel::ORDER_NOT_PAY) ? 'current' : ''; ?>">
                <a href="<?php echo UrlUtil::createUrl("userCenter/order/0/?type=" . OrderModel::ORDER_NOT_PAY); ?>">未支付</a>
            </li>
            <li class="<?php echo ($orderStatus == OrderModel::ORDER_PAYED) ? 'current' : ''; ?>">
                <a href="<?php echo UrlUtil::createUrl("userCenter/order/0/?type=" . OrderModel::ORDER_PAYED); ?>">已支付</a>
            </li>
            <li></li>
            <!--            <li>-->
            <!--                <a href="-->
            <?php //echo UrlUtil::createUrl("userCenter/order/{$offset}/" . OrderModel::ORDER_CONSUMED); ?><!--">已完成</a>-->
            <!--            </li>-->
            <li></li>
        </ul>
    </div>
    <div class="order">
        <?php if ($orders): ?>
            <?php foreach ($orders as $key => $order): ?>
                <dl class="order_list">
                    <dd>
                        <div></div>
                        <samp class="order_number">订单号：
                            <span class="F15"><?php echo $order['order_no']; ?></span></samp>
                    </dd>
                    <dt>
                        <a href="<?php echo UrlUtil::createUrl('project/detail/' . $order['project_id']); ?>">
                            <div class="order_list_dtDiv">
                                <img
                                    src="<?php echo UploadUtil::buildUploadDocPath($order['project_cover'], '100x100'); ?>"/>
                                <h3 class="F14 FN"><?php echo $order['project_name']; ?></h3>
                                <b class="add FN colorH">门店：<span>
                                    <?php echo ($order['shop_id'] && isset($shops[$order['shop_id']])) ? $shops[$order['shop_id']] : '不期而遇门店'; ?>
                                </span>
                                </b> <b class="add FN colorH">门店地址：<span>
                                    <?php echo $shopAddress[$order['shop_id']]; ?>
                                </span>
                                </b>
                                <p>预约时间:<span
                                        class="F11"><?php echo DateUtil::buildDateTime($order['appointment_day'], $order['appointment_start_time']); ?>
                                        <strong
                                            class="add FN colorH">美容师:<?php echo $order['beautician_name']; ?></span>
                                </p></strong>

                                <i class="order_list_i"></i>
                            </div>
                        </a>
                    </dt>
                    <dd>
                        <?php if ($order['order_sign'] == OrderModel::ORDER_NOT_PAY && DateUtil::orderIsValidDate($order['create_time'])): ?>
                            <a class="colorW"
                               href="<?php echo UrlUtil::createUrl('order/pay/' . $order['order_no']); ?>">去支付</a>
                            <a class="colorW cancel-order" data-val="<?php echo $order['order_id']; ?>"
                               style="margin-left: 15px;">取消订单</a>
                        <?php elseif ($order['order_sign'] == OrderModel::ORDER_NOT_PAY && !DateUtil::orderIsValidDate($order['create_time'])): ?>
                            <a class="order-expire">订单已过期</a>
                        <?php elseif ($order['order_sign'] == OrderModel::ORDER_CANCEL): ?>
                            <a class="order-expire">订单已取消</a>
                        <?php elseif ($order['order_sign'] == OrderModel::ORDER_PAYED): ?>
                            <a class="order-payed">已支付</a>
                        <?php else: ?>
                        <?php endif; ?>

                        <i class="colorH">总金额:<strong
                                class="F18 colorR">￥<?php echo $order['total_fee']; ?></strong></i>
                        <P><samp class="colorH">订单状态：</samp><?php echo $order['order_status']; ?></P>
                        <?php if ($order['order_sign'] == OrderModel::ORDER_PAYED): ?>
                            <P><samp class="colorH">支付时间：</samp><?php echo $order['pay_time']; ?></P>
                        <?php endif; ?>
                        <p><samp class="colorH">下单时间：</samp><?php echo $order['create_time']; ?></p>
                    </dd>
                </dl>
            <?php endforeach; ?>

            <div class="list-page"><?php echo $pages; ?></div>
        <?php else: ?>
            <div class="result-wrap">
                <div class="result-content">
                    <div class="tips F16">
                        暂无订单
                    </div>

                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<script type="text/javascript"
        src="<?php echo get_instance()->config->base_url(); ?>static/frontend/js/order.js?v=2015011702"></script>