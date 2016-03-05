<script src="<?php echo get_instance()->config->base_url(); ?>static/backend/js/appointment.js"></script>
<link rel="stylesheet"
      href="<?php echo get_instance()->config->base_url(); ?>static/frontend/css/beautician.css">

<style>
    .appointment-time {
        height: 60px;
    }
</style>
<div class="crumb-wrap">
    <div class="crumb-list"><i class="icon-font"></i>
        <a href="<?php echo UrlUtil::createBackendUrl('project/index'); ?>">首页</a>
        <span class="crumb-step">&gt;</span><span>线下预约</span></div>
</div>
<div class="result-wrap">
    <div class="result-content">
        <?php echo form_open(UrlUtil::createBackendUrl('offlineAppointment/appointment')); ?>
        <input type="hidden" name="appointment_times" value="">
        <table class="insert-tab" width="100%">
            <tbody>

            <tr>
                <th><i class="require-red">*</i>预约商品：</th>
                <td>
                    <input type="hidden" name="project_id" value="<?php echo $project['project_id']; ?>">
                    <input type="hidden" name="use_time" value="<?php echo $project['use_time']; ?>">
                    <input class="common-text required" name="project_name" id="product_name"
                           value="<?php echo $project['project_name']; ?>" size="50" type="text">
                </td>
            </tr>

            <tr>
                <th width="120"><i class="require-red">*</i>预约门店：</th>
                <td>
                    <select name="shop_id" class="required select">
                        <?php $this->load->view('backend/shop/shopList', array('shops' => $shops,
                            'selectShop' => 0, 'hideBelongAllShop' => true)); ?>
                    </select>
                </td>
            </tr>

            <tr>
                <th><i class="require-red">*</i>预约日期：</th>
                <td>
                    <select class="select" name="appointment_day">
                        <?php foreach ($days as $k => $day): ?>
                            <option value="<?php echo $k; ?>">
                                <?php echo $day; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>

            <tr>
                <th width="120"><i class="require-red">*</i>美容师：</th>
                <td>
                    <select class="select" name="beautician_id">
                    <?php foreach ($beauticians as $beautician): ?>
                        <option value="<?php echo $beautician['beautician_id']; ?>">
                            <?php echo $beautician['name']; ?>
                        </option>
                    <?php endforeach; ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <section class="section-two appointment-times"></section>
                </td>
            </tr>

            <tr>
                <th><i class="require-red">*</i>联系人：</th>
                <td>
                    <input class="common-text required" name="user_name"
                           value="<?php echo set_value('user_name'); ?>" size="20" type="text">
                </td>
            </tr>

            <tr>
                <th><i class="require-red">*</i>手机号：</th>
                <td>
                    <input class="common-text required" name="phone_number"
                           value="<?php echo set_value('phone_number'); ?>" size="20" type="text">
                </td>
            </tr>

            <tr>
                <th></th>
                <td>
                    <button class="btn btn-primary btn6 mr10">提交</button>
                </td>
            </tr>
            </tbody>
        </table>
        </form>
    </div>