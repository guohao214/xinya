<div class="crumb-wrap">
    <div class="crumb-list"><i class="icon-font"></i>
        <a href="<?php echo UrlUtil::createBackendUrl('project/index') ?>">首页</a>
        <span class="crumb-step">&gt;</span>
        <a class="crumb-name" href="<?php echo UrlUtil::createBackendUrl('beautician/index') ?>">美容师管理</a>
        <span class="crumb-step">&gt;</span><span>请假记录</span></div>
</div>
<div class="result-wrap">
    <div class="result-content">
        <div class="error">
            <?php echo validation_errors(); ?>
        </div>
        <?php echo form_open(RequestUtil::CM(array('beautician_id' => $beautician_id))); ?>
        <input type="hidden" name="beautician_id" value="<?php echo $beautician_id; ?>">
        <table class="insert-tab" width="100%">
            <tbody>
            <tr>
                <th><i class="require-red">*</i>姓名：</th>
                <td>
                    <label><?php echo $beautician['name']; ?></label>
                </td>
            </tr>

            <tr>
                <th width="120"><i class="require-red">*</i>请假日期：</th>
                <td>
                    <input class="common-text required" name="rest_day" size="20"
                           value="<?php echo set_value('rest_day'); ?>" type="text">
                </td>
            </tr>


            <tr>
                <th width="120"><i class="require-red">*</i>开始时间：</th>
                <td>
                    <input class="common-text required" name="start_time" size="20"
                           value="<?php echo set_value('start_time'); ?>" type="text">
                </td>
            </tr>


            <tr>
                <th width="120"><i class="require-red">*</i>结束时间：</th>
                <td>
                    <input class="common-text required" name="end_time" size="20"
                           value="<?php echo set_value('end_time'); ?>" type="text">
                </td>
            </tr>

            <tr>
                <th width="120"><i class="require-red">*</i>备注：</th>
                <td>
                    <input class="common-text required" name="ps" size="50"
                           value="<?php echo set_value('ps'); ?>" type="text">
                </td>
            </tr>

            <tr>
                <th></th>
                <td>
                    <input class="btn btn-primary btn6 mr10" value="提交" type="submit">
                    <a class="btn btn6" href="<?php echo UrlUtil::createBackendUrl("beautician/rest/{$beautician_id}"); ?>">返回</a>
                </td>
            </tr>
            </tbody>
        </table>
        </form>
    </div>