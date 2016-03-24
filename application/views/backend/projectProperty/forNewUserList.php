<div class="crumb-wrap">
    <div class="crumb-list"><i class="icon-font"></i><a
            href="<?php echo UrlUtil::createBackendUrl('project/index'); ?>">首页</a><span
            class="crumb-step">&gt;</span><span class="crumb-name">新用户专享</span></div>
</div>

<div class="result-wrap">
    <div class="result-title">
        <div class="result-list">
            <a href="<?php echo UrlUtil::createBackendUrl('projectProperty/addForNewUserProject') ?>">
                <i class="icon-font"></i>新增新用户专享项目</a>
        </div>
    </div>
    <div class="result-content">
        <?php if ($projects): ?>
            <table class="result-tab" width="100%">
                <tr>
                    <th width="110">封面</th>
                    <th>项目标题</th>
                    <th>所属分类</th>
                    <th width="100">使用时间</th>
                    <th width="100">价格</th>
                    <th width="80">操作</th>
                </tr>
                <?php foreach ($projects as $project): ?>
                    <tr>
                        <td>
                            <img class="cover"
                                 src="<?php echo UploadUtil::buildUploadDocPath($project['project_cover'], '200x200'); ?>">
                        </td>
                        <td><?php echo $project['project_name']; ?></td>
                        <td><?php echo $categories[$project['category_id']]; ?></td>
                        <td><?php echo $project['use_time']; ?> 分钟</td>
                        <td><?php echo $project['price']; ?> 元</td>
                        <td>
                            <a class="link-del btn btn-danger"
                               href="<?php echo UrlUtil::createBackendUrl('projectProperty/deleteForNewUserProject/' . $project['project_property_id'] . "/{$limit}"); ?>">删除</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <div class="error">暂无新用户专享项目</div>
        <?php endif; ?>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.link-del').on('click', function (e) {
            e.preventDefault();

            if (confirm('确定删除此新用户专享项目？')) {
                window.location.href = $(this).attr('href');
            }
        })
    })
</script>