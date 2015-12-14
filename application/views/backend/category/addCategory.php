<div class="crumb-wrap">
    <div class="crumb-list"><i class="icon-font"></i>
        <a href="<?php echo UrlUtil::createBackendUrl('project/index') ?>">首页</a>
        <span class="crumb-step">&gt;</span>
        <a class="crumb-name" href="<?php echo UrlUtil::createBackendUrl('category/index') ?>">分类管理</a>
        <span class="crumb-step">&gt;</span><span>新增分类</span></div>
</div>
<div class="result-wrap">
    <div class="result-content">
        <form action="/jscss/admin/design/add" method="post" id="myform" name="myform" enctype="multipart/form-data">
            <table class="insert-tab" width="100%">
                <tbody>
                <tr>
                    <th><i class="require-red">*</i>分类标题：</th>
                    <td>
                        <input class="common-text required" id="title" name="title" size="50" value="" type="text">
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <input class="btn btn-primary btn6 mr10" value="提交" type="submit">
                        <input class="btn btn6" onClick="history.go(-1)" value="返回" type="button">
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>