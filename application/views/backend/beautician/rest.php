<div class="crumb-wrap">
    <div class="crumb-list"><i class="icon-font"></i>
        <a href="<?php echo UrlUtil::createBackendUrl('project/index'); ?>">首页</a><span
            class="crumb-step">&gt;</span><span class="crumb-name">美容师管理</span></div>
</div>
<div class="result-wrap">
    <div class="result-title">
        <div class="result-list">
            <a href="<?php echo UrlUtil::createBackendUrl("beautician/addBeauticianRest/{$beautician_id}"); ?>">
                <i class="icon-font"></i>新增 <?php echo $beautician['name']; ?> 的请假记录</a>
            <!--<a id="batchDel" href="javascript:void(0)"><i class="icon-font"></i>批量删除</a>
            <a id="updateOrd" href="javascript:void(0)"><i class="icon-font"></i>更新排序</a>-->
        </div>
    </div>
    <?php if ($beauticianRests): ?>
        <div class="result-content">
            <h1><?php echo $beautician['name']; ?>的请假记录</h1>
            <table class="result-tab" width="100%">
                <tr>
                    <th width="30%">请假日期</th>
                    <th>开始时间</th>
                    <th>结束时间</th>
                    <th>备注</th>
                    <th width="150">操作</th>
                </tr>

                <?php foreach ($beauticianRests as $beauticianRest): ?>
                    <?php $beautician_rest_id = $beauticianRest['beautician_rest_id']; ?>
                    <tr>
                        <td><?php echo $beauticianRest['rest_day']; ?>   <?php echo DateUtil::dayInWeekName($beauticianRest['rest_day']); ?></td>
                        <td><?php echo $beauticianRest['start_time']; ?></td>
                        <td><?php echo $beauticianRest['end_time']; ?></td>
                        <td><?php echo $beauticianRest['ps']; ?></td>
                        <td>
                            <a class="link-del btn btn-danger"
                               href="<?php echo UrlUtil::createBackendUrl("beautician/deleteBeauticianRest/{$beautician_rest_id}"); ?>">删除</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <div class="list-page"><?php echo $pages; ?></div>
        </div>
    <?php else: ?>
        <div class="error">没有请假记录</div>
    <?php endif; ?>
</div>

<script>
    $(document).ready(function () {
        $('.link-del').on('click', function (e) {
            e.preventDefault();

            var $that = $(this);

            if (confirm('确定删除请假记录')) {
                window.location.href = $that.attr('href');
            }
        })
    })
</script>