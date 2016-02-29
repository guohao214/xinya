<link rel="stylesheet" type="text/css" href="<?php echo get_instance()->config->base_url(); ?>static/backend/css/jquery.datetimepicker.css"/>
<script src="<?php echo get_instance()->config->base_url(); ?>static/backend/js/jquery.datetimepicker.js"></script>
<div class="crumb-wrap">
    <div class="crumb-list"><i class="icon-font"></i>
        <a href="<?php echo UrlUtil::createBackendUrl('project/index'); ?>">首页</a>
        <span class="crumb-step">&gt;</span>
        <a class="crumb-name" href="<?php echo UrlUtil::createBackendUrl('couponCode/index') ?>">优惠码管理</a>
        <span class="crumb-step">&gt;</span><span>修改优惠码</span></div>
</div>
<div class="result-wrap">
    <div class="result-content">
        <div class="error">
            <?php echo validation_errors(); ?>
        </div>

        <?php echo form_open(RequestUtil::CM(array($coupon['coupon_code_id'], $limit))); ?>
        <table class="insert-tab" width="100%">
            <tbody>

            <tr>
                <th><i class="require-red">*</i>优惠码：</th>
                <td>
                    <input class="common-text required" name="coupon_code" maxlength="6"
                           value="<?php echo $coupon['coupon_code']; ?>" size="20" type="text">（6位）
                </td>
            </tr>

            <tr>
                <th><i class="require-red">*</i>折扣：</th>
                <td>
                    <input class="common-text required" name="discount"
                           value="<?php echo $coupon['discount']; ?>" size="20" type="text">
                </td>
            </tr>

            <tr>
                <th><i class="require-red">*</i>订单金额：</th>
                <td>
                    <input class="common-text required" name="use_rule"
                           value="<?php echo $coupon['use_rule']; ?>" size="20" type="text">
                </td>
            </tr>

            <tr>
                <th><i class="require-red">*</i>开始时间：</th>
                <td>
                    <input class="common-text required" name="start_time" size="20"
                           value="<?php echo $coupon['start_time']; ?>" type="text">
                </td>
            </tr>

            <tr>
                <th><i class="require-red">*</i>过期时间：</th>
                <td>
                    <input class="common-text required" name="expire_time"
                           value="<?php echo $coupon['expire_time']; ?>" size="20" type="text">
                </td>
            </tr>

            <tr>
                <th></th>
                <td>
                    <input class="btn btn-primary btn6 mr10" value="提交" type="submit">
                    <a class="btn btn6" href="<?php echo UrlUtil::createBackendUrl('couponCode/index'); ?>">返回</a>
                </td>
            </tr>
            </tbody>
        </table>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('[name="expire_time"], [name="start_time"]').datetimepicker({
                lang:'ch',
                timepicker:false,
                format:'Y-m-d',
                formatDate:'Y-m-d',
            });
        })
    </script>