<div class="crumb-wrap">
    <div class="crumb-list"><i class="icon-font"></i><a
            href="<?php echo UrlUtil::createBackendUrl('project/index'); ?>">首页</a><span
            class="crumb-step">&gt;</span><span class="crumb-name">优惠码管理</span></div>
</div>
<div class="search-wrap">
    <div class="search-content">
        <form action="<?php echo UrlUtil::createBackendUrl('couponCode/index'); ?>?" method="get">
            <table class="search-tab">
                <tr>
                    <th width="100">优惠码:</th>
                    <td><input class="common-text" placeholder="优惠码" type="text"
                               name="coupon_code" value="<?php echo defaultValue($params['coupon_code']); ?>"></td>

                    <td><input class="btn btn-primary btn2" type="submit"></td>
                </tr>
            </table>
        </form>
    </div>
</div>
<div class="result-wrap">
    <div class="result-title">
        <div class="result-list">
            <a href="<?php echo UrlUtil::createBackendUrl('couponCode/addCouponCode') ?>">
                <i class="icon-font"></i>新增优惠码</a>
        </div>
    </div>
    <div class="result-content">
        <?php if ($coupons): ?>
            <table class="result-tab" width="100%">
                <tr>
                    <th>优惠码</th>
                    <th>订单金额</th>
                    <th>折扣</th>
                    <th>已使用次数</th>
                    <th width="100">开始使用时间</th>
                    <th width="100">过期时间</th>
                    <th width="150">添加时间</th>
                    <th width="150">操作</th>
                </tr>
                <?php foreach ($coupons as $coupon): ?>
                    <tr>
                        <td><?php echo $coupon['coupon_code']; ?></td>
                        <td><?php echo $coupon['use_rule']; ?></td>
                        <td><?php echo $coupon['discount']; ?></td>
                        <td><?php echo $coupon['use_times']; ?></td>
                        <td><?php echo $coupon['start_time']; ?></td>
                        <td><?php echo $coupon['expire_time']; ?></td>
                        <td><?php echo $coupon['create_time']; ?></td>
                        <td>
                            <a class="link-update btn btn-warning"
                               href="<?php echo UrlUtil::createBackendUrl('couponCode/updateCouponCode/' . $coupon['coupon_code_id'] ."/{$limit}"); ?>">修改</a>
                            <a class="link-del btn btn-danger"
                               href="<?php echo UrlUtil::createBackendUrl('couponCode/deleteCouponCode/' . $coupon['coupon_code_id']."/{$limit}"); ?>">删除</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <div class="list-page"><?php echo $pages; ?></div>
        <?php else: ?>
            <div class="error">暂无优惠码</div>
        <?php endif; ?>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.link-del').on('click', function (e) {
            e.preventDefault();

            if (confirm('确定删除此优惠码？')) {
                window.location.href = $(this).attr('href');
            }
        })
    })
</script>