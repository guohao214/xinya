<script type="text/javascript" src="<?php echo get_instance()->config->base_url(); ?>static/frontend/js/cart.js?v=2015010301"></script>
<header>
    <h2>购物车</h2>
</header>
<section>
    <div class="order">
        <dl class="order_list">
            <dt>
                <?php $totalAmount = 0; ?>

                <?php foreach ($projects as $project): ?>
                <?php $inCartNum = $cart[$project['project_id']] + 0; ?>
                <?php $inCartPrice = $inCartNum * $project['price']; ?>
                <?php $totalAmount += $inCartPrice; ?>

            <div class="order_list_dtDiv">
                <a href="<?php echo UrlUtil::createUrl('project/detail/' . $project['project_id']); ?>">
                    <img src="<?php echo UploadUtil::buildUploadDocPath($project['project_cover'], '100x100'); ?>"/>
                </a>
                <a href="<?php echo UrlUtil::createUrl('project/detail/' . $project['project_id']); ?>">
                    <h3 class="F14 FN"><?php echo $project['project_name']; ?></h3>
                </a>
                <b class="add FN colorH">店铺：<span>
                        <?php echo ($project['shop_id'] > 0) ? $shops[$project['shop_id']] : '所有门店'; ?>
                    </span></b>
                <!--<p>预约时间:<span class="F14">2015-08-17 上午</span></p>-->
                <i class="order_list_i">
                    <p><strong class="FN colorH">单价:<b class="F14 price">￥<?php echo $project['price']; ?></b></strong></p>
                    <strong class="FN colorH in-cart-prices">金额:<b class="F14">￥</b><b
                                class="F14 in-cart-price"><?php echo number_format($inCartPrice, 2); ?></b></strong>
                    <samp class="colorW count">
                        <a data-price="<?php echo $project['price']; ?>" class="subProject"
                           data-id="<?php echo $project['project_id']; ?>">-</a>
                        <input class="projectNum" type="text" value="<?php echo $inCartNum; ?>" maxlength="3">
                        <a data-price="<?php echo $project['price']; ?>" class="incProject"
                           data-id="<?php echo $project['project_id']; ?>">+</a>
                    </samp>
                </i>
            </div>
            <?php endforeach; ?>

            </dt>
            <dd>
                <a class="colorW" href="javascript:; " onclick="document.body.id = 'msgBody'; ">去结算</a>
                <i class="colorH">总金额:<strong
                        class="F18 colorR">￥</strong> <strong
                        class="F18 colorR totalAmount"><?php echo $totalAmount; ?></strong></i>
                <!--<P><samp class="colorH">支付状态：</samp>未支付</P>-->
            </dd>
        </dl>

    </div>
</section>


<div id="divMsg">
    <form action="<?php echo UrlUtil::createUrl('cart/order'); ?>" id="create-order" method="post">
        <div class="pay">
            <strong>
                <a id="aClose" href="javascript:; " onclick="document.body.id = ''; "></a>
                <span class="F16">完善信息</span>
            </strong>
            <ul>
                <li>
                    <samp>联系人：</samp>
                    <span><input type="text" name="user_name" class="order-text"></span>
                </li>
                <li>
                    <samp>手机号：</samp>
                    <span><input type="tel" name="phone" class="order-text"></span>
                </li>
                <!--<li>
                    <samp class="F16"></samp>
                    <span class="F18"></span>
                </li>-->
            </ul>
            <a class="payment colorW F16" type="submit">提交订单</a>
        </div>
    </form>
</div>
