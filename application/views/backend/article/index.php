<div class="crumb-wrap">
    <div class="crumb-list"><i class="icon-font"></i><a href="index.html">首页</a><span
            class="crumb-step">&gt;</span><span class="crumb-name">项目管理</span></div>
</div>
<div class="search-wrap">
    <div class="search-content">
        <form action="<?php echo UrlUtil::createBackendUrl('article/index'); ?>?" method="get">
            <table class="search-tab">
                <tr>
                    <th width="70">标题:</th>
                    <td><input class="common-text" placeholder="标题" type="text"
                               name="title" value="<?php echo defaultValue($params['title']); ?>"></td>

                    <th width="70">别名:</th>
                    <td><input class="common-text" placeholder="别名" type="text"
                               name="alias_name" value="<?php echo defaultValue($params['alias_name']); ?>"></td>

                    <td><input class="btn btn-primary btn2" type="submit"></td>
                </tr>
            </table>
        </form>
    </div>
</div>
<div class="result-wrap">
        <div class="result-title">
            <div class="result-list">
                <a href="<?php echo UrlUtil::createBackendUrl('article/addArticle') ?>">
                    <i class="icon-font"></i>新增文章</a>
            </div>
        </div>
        <div class="result-content">
            <?php if ($articles): ?>
                <table class="result-tab" width="100%">
                    <tr>
                        <th>标题</th>
                        <th width="300">别名</th>
                        <th width="210">操作</th>
                    </tr>
                    <?php foreach ($articles as $article): ?>
                        <tr>
                            <td><?php echo $article['title']; ?></td>
                            <td><?php echo $article['alias_name']; ?></td>
                            <td>
                                <a class="link-view btn btn-success"
                                   href="<?php echo UrlUtil::createBackendUrl('article/articleDetail/' . $article['article_id']); ?>">详情</a>
                                <a class="link-update btn btn-warning"
                                   href="<?php echo UrlUtil::createBackendUrl('article/updateArticle/' . $article['article_id']); ?>">修改</a>
                                <a class="link-del btn btn-danger"
                                   href="<?php echo UrlUtil::createBackendUrl('article/deleteArticle/' . $article['article_id']); ?>">删除</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <div class="list-page"><?php echo $pages; ?></div>
            <?php else: ?>
                <div class="error">暂无文章</div>
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