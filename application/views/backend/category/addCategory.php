<div class="crumb-wrap">
    <div class="crumb-list"><i class="icon-font"></i>
        <a href="<?php echo UrlUtil::createBackendUrl('project/index') ?>">首页</a>
        <span class="crumb-step">&gt;</span>
        <a class="crumb-name" href="<?php echo UrlUtil::createBackendUrl('category/index') ?>">分类管理</a>
        <span class="crumb-step">&gt;</span><span>新增分类</span></div>
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
                <th><i class="require-red">*</i>分类标题：</th>
                <td>
                    <input class="common-text required" name="category_name" size="50"
                           value="<?php echo set_value('category_name'); ?>" type="text">
                </td>
            </tr>

            <tr>
                <th><i class="require-red">*</i>排序：</th>
                <td>
                    <input class="common-text required" name="order_sort" size="10"
                           value="<?php echo set_value('order_sort'); ?>" type="text">
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <input class="btn btn-primary btn6 mr10" value="提交" type="submit">
                    <a class="btn btn6" href="<?php echo UrlUtil::createBackendUrl('category/index'); ?>">返回</a>
                </td>
            </tr>
            </tbody>
        </table>
        </form>
    </div>