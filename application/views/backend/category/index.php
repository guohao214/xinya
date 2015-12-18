<div class="crumb-wrap">
    <div class="crumb-list"><i class="icon-font"></i><a href="index.html">首页</a><span
            class="crumb-step">&gt;</span><span class="crumb-name">项目管理</span></div>
</div>

<div class="result-wrap">
    <form name="myform" id="myform" method="post">
        <div class="result-title">
            <div class="result-list">
                <a href="<?php echo UrlUtil::createBackendUrl('category/addCategory') ?>">
                    <i class="icon-font"></i>新增分类</a>
                <!--<a id="batchDel" href="javascript:void(0)"><i class="icon-font"></i>批量删除</a>
                <a id="updateOrd" href="javascript:void(0)"><i class="icon-font"></i>更新排序</a>-->
            </div>
        </div>
        <?php if ($categories): ?>
            <div class="result-content">
                <table class="result-tab" width="100%">
                    <tr>
                        <th width="10%">ID</th>
                        <th width="50%">标题</th>
                        <th width="10%">项目数</th>
                        <th>更新时间</th>
                        <th>操作</th>
                    </tr>

                    <?php foreach ($categories as $category): ?>
                        <?php $categoryId = $category['category_id']; ?>
                        <tr>
                            <td><?php echo $categoryId; ?></td>
                            <td><?php echo $category['category_name']; ?></td>
                            <td><?php echo $category['projects']; ?></td>
                            <td><?php echo $category['create_time']; ?></td>
                            <td>
                                <a class="link-update"
                                   href="<?php echo UrlUtil::createBackendUrl("category/updateCategory/{$categoryId}"); ?>"">修改</a>
                                <a class="link-del"
                                   href="<?php echo UrlUtil::createBackendUrl("category/deleteCategory/{$categoryId}"); ?>">删除</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        <?php endif; ?>
    </form>
</div>

<script>
    $(document).ready(function () {
        $('.link-del').on('click', function (e) {
            e.preventDefault();

            var $that = $(this);

            if (confirm('确定删除当前分类?')) {
                window.location.href = $that.attr('href');
            }
        })
    })
</script>