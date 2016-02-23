<link rel="stylesheet" type="text/css"
      href="<?php echo get_instance()->config->base_url(); ?>static/backend/css/jquery.datetimepicker.css"/>
<script src="<?php echo get_instance()->config->base_url(); ?>static/backend/js/jquery.datetimepicker.js"></script>
<div class="crumb-wrap">
    <div class="crumb-list"><i class="icon-font"></i>
        <a href="<?php echo UrlUtil::createBackendUrl('project/index') ?>">首页</a>
        <span class="crumb-step">&gt;</span>
        <a class="crumb-name" href="<?php echo UrlUtil::createBackendUrl('beautician/index') ?>">美容师管理</a>
        <span class="crumb-step">&gt;</span><span>修改工作时间</span></div>
</div>
<div class="result-wrap">
    <div class="result-content">
        <div class="error">
            <?php echo validation_errors(); ?>
        </div>
        <div class="result-title">
            <div class="result-list">
                <h1><?php echo $beautician['name']; ?> 的工作时间</h1>
            </div>
        </div>
        <?php echo form_open(RequestUtil::CM(array('beautician_id' => $beauticianId))); ?>
        <table class="insert-tab" width="100%">
            <tbody>
            <?php foreach ($beauticianWorkTime as $key => $workTime): ?>
            <tr>
                <th><?php echo DateUtil::inWeekName($key); ?> ：</th>
                <td>
                    <?php foreach ($timeSetting as $timeKey => $setting): ?>
                        <?php $selected = ($workTime == $timeKey) ? ' checked' :''; ?>
                        <input type="radio" name="work_type_<?php echo $key; ?>"
                               value="<?php echo $timeKey; ?>"<?php echo $selected; ?>>&nbsp;<?php echo $setting; ?> &nbsp;&nbsp;
                    <?php endforeach; ?>
                </td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <th></th>
                <td>
                    <input class="btn btn-primary btn6 mr10" value="提交" type="submit">
                    <a class="btn btn6" href="<?php echo UrlUtil::createBackendUrl('beautician/index'); ?>">返回</a>
                </td>
            </tr>
            </tbody>
        </table>
        </form>
    </div>