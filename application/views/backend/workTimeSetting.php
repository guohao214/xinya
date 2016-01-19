<link rel="stylesheet" type="text/css"
      href="<?php echo get_instance()->config->base_url(); ?>static/backend/css/jquery.datetimepicker.css"/>
<script src="<?php echo get_instance()->config->base_url(); ?>static/backend/js/jquery.datetimepicker.js"></script>

<div class="crumb-wrap">
    <div class="crumb-list"><i class="icon-font"></i>
        <a href="<?php echo UrlUtil::createBackendUrl('project/index') ?>">首页</a>
        <span class="crumb-step">&gt;</span><span>设置工作时间</span></div>
</div>
<div class="result-wrap">
    <div class="result-content">
        <div class="error">
            <?php echo validation_errors(); ?>
        </div>

        <?php echo form_open(RequestUtil::CM()); ?>
        <table class="insert-tab" width="100%">
            <tbody>
            <tr>
                <th><i class="require-red">*</i>工作时间：</th>
                <td>
                    <input class="common-text required time-picker" name="allDayStart"
                           value="<?php echo $setting['allDayStart']; ?>" size="15" type="text"> -
                    <input class="common-text required time-picker" name="allDayEnd"
                           value="<?php echo $setting['allDayEnd']; ?>" size="15" type="text">
                </td>
            </tr>

            <tr>
                <th><i class="require-red">*</i>早班时间：</th>
                <td>
                    <input class="common-text required time-picker" name="morningShiftStart"
                           value="<?php echo $setting['morningShiftStart']; ?>" size="15" type="text"> -
                    <input class="common-text required time-picker" name="morningShiftEnd"
                           value="<?php echo $setting['morningShiftEnd']; ?>" size="15" type="text">
                </td>
            </tr>
            <tr>
                <th><i class="require-red">*</i>晚班时间：</th>
                <td>
                    <input class="common-text required time-picker" name="nightShiftStart"
                           value="<?php echo $setting['nightShiftStart']; ?>" size="15" type="text"> -
                    <input class="common-text required time-picker" name="nightShiftEnd"
                           value="<?php echo $setting['nightShiftEnd']; ?>" size="15" type="text">
                </td>
            </tr>

            <tr>
                <th></th>
                <td>
                    <input class="btn btn-primary btn6 mr10" value="提交" type="submit">
                </td>
            </tr>
            </tbody>
        </table>
        </form>
    </div>


    <script>
        $(document).ready(function () {
            $('.time-picker').datetimepicker({
                datepicker: false,
                format: 'H:i',
                step: 30
            });
        })
    </script>