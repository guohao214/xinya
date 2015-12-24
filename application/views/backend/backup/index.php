<div class="crumb-wrap">
    <div class="crumb-list"><i class="icon-font"></i><a href="index.html">首页</a><span
            class="crumb-step">&gt;</span><span class="crumb-name">备份管理</span></div>
</div>
<div class="search-wrap">
    <div class="search-content"></div>
</div>
<div class="result-wrap">
        <div class="result-title">
            <div class="result-list">
                <a href="<?php echo UrlUtil::createBackendUrl('tool/backup') ?>">
                    <i class="icon-font"></i>备份</a>
            </div>
        </div>
        <div class="result-content">
            <?php if ($backups): ?>
                <table class="result-tab" width="100%">
                    <tr>
                        <th width="60%">文件地址</th>
                        <th width="100">备份时间</th>
                        <th width="140">操作</th>
                    </tr>
                    <?php foreach ($backups as $backup): ?>
                        <tr>
                            <td><?php echo $backup['file_path']; ?></td>
                            <td><?php echo $backup['create_time']; ?></td>
                            <td>
                                <a class="link-update btn btn-success"
                                   href="<?php echo UrlUtil::createBackendUrl('tool/download/' . $backup['backup_id']); ?>">下载</a>
                                <a class="link-del btn btn-danger"
                                   href="<?php echo UrlUtil::createBackendUrl('tool/deleteBackup/' . $backup['backup_id']); ?>">删除</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <div class="list-page"><?php echo $pages; ?></div>
            <?php else: ?>
                <div class="error">暂无项目</div>
            <?php endif; ?>
        </div>
</div>

<script>
    $(document).ready(function () {
        $('.link-del').on('click', function (e) {
            e.preventDefault();

            if (confirm('删除备份？')) {
                window.location.href = $(this).attr('href');
            }
        })
    })
</script>