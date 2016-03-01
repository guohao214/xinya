<link rel="stylesheet"
      href="<?php echo get_instance()->config->base_url(); ?>static/frontend/css/exchange-product.css?v=20160301">
<header>
    <h2>已兑换商品</h2>
</header>
<section>

    <?php if ($exchangeGoods): ?>
        <?php foreach ($exchangeGoods as $product): ?>
            <div class="itemlist loaded">
                <div class="item ">
                    <dl>
                        <dt>
                            <img
                                src="<?php echo UploadUtil::buildUploadDocPath($product['exchange_goods_pic'], '100x100'); ?>">
                        </dt>
                        <dd>
                            <h3><?php echo $product['exchange_goods_name']; ?></h3>
                            <p class="effects F13">领取门店：<?php echo $shops[$product['exchange_shop_id']]; ?></p>
                            <p class="effects F13">
                                联系方式：<?php echo $product['contact_name']; ?> - <?php echo $product['contact_phone']; ?></p>
                            <p class="price F18" style="height: auto;">
                                <i class="F12 FN">
                                    兑换时间：</i><?php echo DateUtil::getOnlyDay($product['exchange_time']); ?>

                                <!--<cite class="appointment FN">预约</cite><!--<b>103人推荐</b>-->
                            </p>
                            <?php if ($product['is_get']): ?>
                                <p class="price F18">
                                <i class="F12 FN">领取时间：</i>
                                <?php echo DateUtil::getOnlyDay($product['get_time']); ?>
                            <?php else: ?>
                            <p class="exchange"><span class="do-exchange">待领取</span></p>
                        <?php endif;?>
                        </dd>
                    </dl>
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
                    暂无已兑换的商品
                </div>
            </div>
        </div>
    <?php endif; ?>

</section>


<div id="divMsg">
    <div class="pay">
        <strong>
            <a id="aClose" href="javascript:; " onclick="document.body.id = ''; "></a>
            <span class="F16">请输入联系信息</span>
        </strong>
        <ul>
            <li>
                <samp>联系人：</samp>
                <span><input type="text" name="contact_name" class="order-text"
                             value="<?php echo $lastOrder['user_name']; ?>"> </span>
            </li>
            <li>
                <a href="#">
                    <samp>手机号：</samp>
                    <span><input type="tel" name="contact_phone" class="order-text" maxlength="11"
                                 value="<?php echo $lastOrder['phone_number']; ?>"></span>
                </a>
            </li>
        </ul>
        <a class="confirm-exchange payment colorW F16">确定兑换</a>
    </div>
</div>