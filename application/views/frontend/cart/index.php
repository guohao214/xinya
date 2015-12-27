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
                    <img src="<?php echo UploadUtil::buildUploadDocPath($project['project_cover'], '200x200'); ?>"/>
                </a>
                <a href="<?php echo UrlUtil::createUrl('project/detail/' . $project['project_id']); ?>">
                    <h3 class="F14 FN"><?php echo $project['project_name']; ?></h3>
                </a>
                <b class="add FN colorH">店铺：<span>
                        <?php echo ($project['shop_id'] > 0) ? $shops[$project['shop_id']] : '所有门店'; ?>
                    </span></b>
                <!--<p>预约时间:<span class="F14">2015-08-17 上午</span></p>-->
                <p></p>
                <i class="order_list_i">
                    <p><strong class="FN colorH">单价:<b class="F14">￥<?php echo $project['price']; ?></b></strong></p>
                    <!--<strong class="FN colorH">金额:<b
                            class="F14">￥<?php echo number_format($inCartPrice, 2); ?></b></strong>-->
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
                <a class="colorW" href="<?php echo UrlUtil::createUrl('cart/order'); ?>">去结算</a>
                <i class="colorH">总金额:<strong
                        class="F18 colorR">￥</strong> <strong
                        class="F18 colorR totalAmount"><?php echo number_format($totalAmount, 2); ?></strong></i>
                <!--<P><samp class="colorH">支付状态：</samp>未支付</P>-->
            </dd>
        </dl>

    </div>
</section>

<script>
    $(document).ready(function () {
        $('.subProject, .incProject').on('click', function () {
            var $that = $(this);

            var $project = $that.siblings('.projectNum'),
                $projectNum = parseInt($project.val()),
                $projectId = parseInt($that.attr('data-id')),
                $price = parseFloat($that.attr('data-price')),
                $totalAmount = $('.totalAmount'),
                $totalFee = parseFloat($totalAmount.html());

            // 减
            if ($that.hasClass('subProject')) {
                if ($projectNum <= 0) {
                    return false;
                } else {
                    $.getJSON(document_root + 'cart/deleteCart/' + $projectId, {}, function (data) {
                        if (data.status == 1) {
                            --$projectNum;
                            if ($projectNum == 0) {
                                $that.parents('.order_list_dtDiv').fadeOut('slow').remove();
                            }

                            $project.val($projectNum);
                            $totalFee -= $price;
                            $totalAmount.html($totalFee.toFixed(2));
                        }
                    })
                }
            }

            // 加
            if ($that.hasClass('incProject')) {
                $.getJSON(document_root + 'cart/addCart/' + $projectId, {}, function (data) {
                    if (data.status == 1) {
                        $project.val(++$projectNum);
                        $totalFee += $price;
                        $totalAmount.html($totalFee.toFixed(2));
                    }
                })
            }

        })
    })
</script>