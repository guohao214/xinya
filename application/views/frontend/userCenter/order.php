<header>
    <a class="prev j_prePage" href="javascript:window.history.back();"></a>
    <h2>我的订单</h2>
</header>

<section>
    <div class="tab_wrap">
        <ul class="tabs j_scroll" id="iScroll0" style="">
            <li class="cur">
                <a><i></i>全部</a>
            </li>
            <li class="">
                <a>未支付</a>
            </li>
            <li>
                <a>已支付</a>
            </li>
            <li>
                <a>已完成</a>
            </li>
            <li>
                <a>未完成</a>
            </li>
        </ul>
    </div>
    <div class="order">

        <?php foreach ($orders as $key => $order): ?>
            <dl class="order_list">
                <dd>
                    <div></div>
                    <samp class="order_number">订单号：
                        <span class="F18"><?php echo $key; ?></span></samp>
                    <a class="F14"></a>
                </dd>
                <?php foreach ($order as $od): ?>
                    <dt>
                        <a href="<?php echo UrlUtil::createUrl('project/detail/' . $od['project_id']); ?>">
                            <div class="order_list_dtDiv">
                                <img
                                    src="<?php echo UploadUtil::buildUploadDocPath($od['project_cover'], '100x100'); ?>"/>
                                <h3 class="F14 FN"><?php echo $od['project_name']; ?></h3>
                                <b class="add FN colorH">店铺：<span>
                                    <?php echo ($order['shop_id'] && isset($shops[$od['order_id']])) ? $shops[$od['order_id']] : '所有门店'; ?>
                                </span></b>
                                <p>预约时间:<span class="F14">2015-08-17 上午</span></p>
                                <i class="order_list_i">
                                    <strong class="FN colorH">价格:<b
                                            class="F14">￥<?php echo $od['total_fee']; ?></b></strong>
                                    <samp class="colorW count_ON">数量
                                        <?php echo $od['buy_counts']; ?>
                                    </samp>
                                </i>
                            </div>
                        </a>
                    </dt>
                <?php endforeach; ?>
                <dd>
                    <?php if ($od['order_sign'] == OrderModel::ORDER_NOT_PAY): ?>
                    <a class="colorW" href="confirmation.html">去支付</a>
                    <?php endif ;?>
                    <i class="colorH">总金额:<strong class="F18 colorR">￥864</strong></i>
                    <P><samp class="colorH">支付状态：</samp><?php echo $od['order_status']; ?></P>
                </dd>
            </dl>
        <?php endforeach; ?>

        <div class="list-page"><?php echo $pages; ?></div>
    </div>
</section>