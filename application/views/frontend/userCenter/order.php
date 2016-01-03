<header>
    <a class="prev j_prePage" href="javascript:window.history.back();"></a>
    <h2>我的订单</h2>
</header>

<section>
    <div class="tab_wrap">
        <ul class="tabs j_scroll" id="iScroll0" style="">
            <li class="cur">
                <a href="<?php echo UrlUtil::createUrl("userCenter/order/0"); ?>"><i></i>全部</a>
            </li>
            <li class="">
                <a href="<?php echo UrlUtil::createUrl("userCenter/order/0/" . OrderModel::ORDER_NOT_PAY); ?>">未支付</a>
            </li>
            <li>
                <a href="<?php echo UrlUtil::createUrl("userCenter/order/0/" . OrderModel::ORDER_PAYED); ?>">已支付</a>
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
                <?php $totalAmount = 0; ?>
                <dl class="order_list">
                    <dd>
                        <div></div>
                        <samp class="order_number">订单号：
                            <span class="F18"><?php echo $key; ?></span></samp>
                    </dd>
                    <?php foreach ($order as $od): ?>
                        <?php $totalAmount += $od['total_fee']; ?>
                        <dt>
                            <a href="<?php echo UrlUtil::createUrl('project/detail/' . $od['project_id']); ?>">
                                <div class="order_list_dtDiv">
                                    <img
                                        src="<?php echo UploadUtil::buildUploadDocPath($od['project_cover'], '100x100'); ?>"/>
                                    <h3 class="F14 FN"><?php echo $od['project_name']; ?></h3>
                                    <b class="add FN colorH">店铺：<span>
                                    <?php echo ($order['shop_id'] && isset($shops[$od['order_id']])) ? $shops[$od['order_id']] : '所有门店'; ?>
                                </span></b>
                                    <?php if ($od['order_sign'] == OrderModel::ORDER_PAYED || $od['order_sign'] == OrderModel::ORDER_CONSUMED): ?>
                                        <p>消费码:<span class="F14"><?php echo $od['consume_code']; ?></span></p>
                                    <?php else: ?>
                                        <p>消费码:<span class="F14">无</span></p>
                                    <?php endif; ?>

                                    <i class="order_list_i">
                                        <strong class="FN colorH">价格:<b
                                                class="F14">￥<?php echo number_format($od['total_fee'], 2); ?></b></strong>


                                        <?php if ($od['order_sign'] == OrderModel::ORDER_PAYED): ?>
                                            <samp class="colorW count_ON">待消费</samp>
                                        <?php endif; ?>

                                        <?php if ($od['order_sign'] == OrderModel::ORDER_CONSUMED): ?>
                                            <samp class="colorW count_ON">已消费</samp>
                                        <?php endif; ?>


                                    </i>
                                </div>
                            </a>
                        </dt>
                    <?php endforeach; ?>
                    <dd>
                        <?php if ($od['order_sign'] == OrderModel::ORDER_NOT_PAY && DateUtil::orderIsValidDate($od['create_time'])): ?>
                            <a class="colorW"
                               href="<?php echo UrlUtil::createUrl('order/pay/' . $od['order_no']); ?>">去支付</a>
                        <?php endif; ?>

                        <?php if (!DateUtil::orderIsValidDate($od['create_time'])): ?>
                            <a style="background-color: #CCCCCC; color: white;">订单已过期</a>
                        <?php endif; ?>


                        <i class="colorH">总金额:<strong class="F18 colorR">￥<?php echo $totalAmount; ?></strong></i>
                        <P><samp class="colorH">订单状态：</samp><?php echo $od['order_status']; ?></P>
                        <?php if ($od['order_sign'] == OrderModel::ORDER_PAYED): ?>
                            <P><samp class="colorH">支付时间：</samp><?php echo $od['pay_time']; ?></P>
                        <?php endif; ?>
                        <p><samp class="colorH">下单时间：</samp><?php echo $od['create_time']; ?></p>
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