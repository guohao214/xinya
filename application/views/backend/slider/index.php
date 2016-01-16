<div class="crumb-wrap">
    <div class="crumb-list"><i class="icon-font"></i><a href="<?php echo UrlUtil::createBackendUrl('project/index'); ?>">首页</a><span
            class="crumb-step">&gt;</span><span class="crumb-name">幻灯片管理</span></div>
</div>
<div class="result-wrap">
        <div class="result-title">
            <div class="result-list">
                <a href="<?php echo UrlUtil::createBackendUrl('slider/addSlider') ?>">
                    <i class="icon-font"></i>新增</a>
            </div>
        </div>
        <div class="result-content">
            <?php if ($sliders): ?>
                <table class="result-tab" width="100%">
                    <tr>
                        <th width="110">图片</th>
                        <th>标题</th>
                        <th>链接</th>
                        <th width="100">分类</th>
                        <th width="100">排序</th>
                        <th width="140">操作</th>
                    </tr>
                    <?php foreach ($sliders as $slider): ?>
                        <tr>
                            <td>
                                <img class="cover"
                                     src="<?php echo UploadUtil::buildUploadDocPath($slider['pic'], '200x200'); ?>">
                            </td>
                            <td><?php echo $slider['title']; ?></td>
                            <td><?php echo $slider['href']; ?></td>
                            <td><?php echo $slider['slider_type']; ?></td>
                            <td><?php echo $slider['order_sort']; ?></td>
                            <td>
                                <a class="btn btn-warning"
                                   href="<?php echo UrlUtil::createBackendUrl('slider/updateSlider/' . $slider['slider_id']); ?>">修改</a>
                                <a class="link-del btn btn-danger"
                                   href="<?php echo UrlUtil::createBackendUrl('slider/deleteSlider/' . $slider['slider_id']); ?>">删除</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <div class="list-page"><?php echo $pages; ?></div>
            <?php else: ?>
                <div class="error">暂无幻灯片</div>
            <?php endif; ?>
        </div>
</div>

<script>
    $(document).ready(function () {
        $('.link-del').on('click', function (e) {
            e.preventDefault();

            if (confirm('确定删除此项目？')) {
                window.location.href = $(this).attr('href');
            }
        })
    })
</script>