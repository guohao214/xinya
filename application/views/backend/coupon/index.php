<div class="crumb-wrap">
    <div class="crumb-list"><i class="icon-font"></i><a
            href="<?php echo UrlUtil::createBackendUrl('project/index'); ?>">首页</a><span
            class="crumb-step">&gt;</span><span class="crumb-name">优惠券管理</span></div>
</div>
<div class="search-wrap">
    <div class="search-content">
        <form action="<?php echo UrlUtil::createBackendUrl('coupon/index'); ?>?" method="get">
            <table class="search-tab">
                <tr>
                    <th width="100">优惠券名称:</th>
                    <td><input class="common-text" placeholder="优惠券名称" type="text"
                               name="coupon_name" value="<?php echo defaultValue($params['coupon_name']); ?>"></td>

                    <td><input class="btn btn-primary btn2" type="submit"></td>
                </tr>
            </table>
        </form>
    </div>
</div>
<div class="result-wrap">
    <div class="result-title">
        <div class="result-list">
            <a href="<?php echo UrlUtil::createBackendUrl('coupon/addCoupon') ?>">
                <i class="icon-font"></i>新增优惠券</a>
        </div>
    </div>
    <div class="result-content">
        <?php if ($coupons): ?>
            <table class="result-tab" width="100%">
                <tr>
                    <th>优惠券名称</th>
                    <th>兑换的积分</th>
                    <th>抵消的金额</th>
                    <th>订单金额</th>
                    <th>发布数量</th>
                    <th>可用数量</th>
                    <th width="100">开始使用时间</th>
                    <th width="100">过期时间</th>
                    <th width="150">添加时间</th>
                    <th width="150">操作</th>
                </tr>
                <?php foreach ($coupons as $coupon): ?>
                    <tr>
                        <td><?php echo $coupon['coupon_name']; ?></td>
                        <td><?php echo $coupon['exchange_credits']; ?></td>
                        <td><?php echo $coupon['counteract_amount']; ?></td>
                        <td><?php echo $coupon['use_rule']; ?></td>
                        <td><?php echo $coupon['total_number']; ?></td>
                        <td><?php echo $coupon['remain_number']; ?></td>
                        <td><?php echo $coupon['start_time']; ?></td>
                        <td><?php echo $coupon['expire_time']; ?></td>
                        <td><?php echo $coupon['create_time']; ?></td>
                        <td>
                            <a class="link-update btn btn-warning"
                               href="<?php echo UrlUtil::createBackendUrl('coupon/updateCoupon/' . $coupon['coupon_id'] ."/{$limit}"); ?>">修改</a>
                            <a class="link-del btn btn-danger"
                               href="<?php echo UrlUtil::createBackendUrl('coupon/deleteCoupon/' . $coupon['coupon_id']."/{$limit}"); ?>">删除</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <div class="list-page"><?php echo $pages; ?></div>
        <?php else: ?>
            <div class="error">暂无优惠券</div>
        <?php endif; ?>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.link-del').on('click', function (e) {
            e.preventDefault();

            if (confirm('确定删除此优惠券？')) {
                window.location.href = $(this).attr('href');
            }
        })
    })
</script>