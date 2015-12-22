<div class="crumb-wrap">
    <div class="crumb-list"><i class="icon-font"></i>
        <a href="<?php echo UrlUtil::createBackendUrl('project/index') ?>">首页</a>
        <span class="crumb-step">&gt;</span>
        <a class="crumb-name" href="<?php echo UrlUtil::createBackendUrl('article/index') ?>">文章管理</a>
        <span class="crumb-step">&gt;</span><span>查看文章</span></div>
</div>
<div class="result-wrap">
    <div class="result-content">

        <table class="insert-tab" width="100%">
            <tbody>
            <tr>
                <th><i class="require-red">*</i>标题：</th>
                <td><?php echo $article['title']; ?></label>
                </td>
            </tr>
            <tr>
                <th><i class="require-red">*</i>别名：</th>
                <td><?php echo $article['alias_name']; ?></td></tr>
            </tr>

            <tr>
                <th><i class="require-red">*</i>内容：</th>
                <td><?php echo $article['content']; ?></td>
            </tr>

            <tr>
                <th></th>
                <td>
                    <a class="btn btn6" href="<?php echo UrlUtil::createBackendUrl('article/index'); ?>">返回</a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>