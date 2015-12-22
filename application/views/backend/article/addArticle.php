<div class="crumb-wrap">
    <div class="crumb-list"><i class="icon-font"></i>
        <a href="<?php echo UrlUtil::createBackendUrl('project/index') ?>">首页</a>
        <span class="crumb-step">&gt;</span>
        <a class="crumb-name" href="<?php echo UrlUtil::createBackendUrl('article/index') ?>">文章管理</a>
        <span class="crumb-step">&gt;</span><span>新增文章</span></div>
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
                <th><i class="require-red">*</i>标题：</th>
                <td>
                    <input class="common-text required" name="title"
                           value="<?php echo set_value('title'); ?>" size="50" type="text">
                </td>
            </tr>
            <tr>
                <th><i class="require-red">*</i>别名：</th>
                <td><input class="common-text" value="<?php echo set_value('alias_name'); ?>"
                           name="alias_name" size="50" type="text"></td>
            </tr>

            <tr>
                <th><i class="require-red">*</i>内容：</th>
                <td>
                    <textarea name="content"
                              class="common-textarea" rows="10"><?php echo set_value('content'); ?></textarea></td>
            </tr>

            <tr>
                <th></th>
                <td>
                    <input class="btn btn-primary btn6 mr10" value="提交" type="submit">
                    <a class="btn btn6" href="<?php echo UrlUtil::createBackendUrl('article/index'); ?>">返回</a>
                </td>
            </tr>
            </tbody>
        </table>
        </form>
    </div>