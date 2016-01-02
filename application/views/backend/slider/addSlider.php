<div class="crumb-wrap">
    <div class="crumb-list"><i class="icon-font"></i>
        <a href="<?php echo UrlUtil::createBackendUrl('project/index'); ?>">首页</a>
        <span class="crumb-step">&gt;</span>
        <a class="crumb-name" href="<?php echo UrlUtil::createBackendUrl('slider/index') ?>">幻灯片管理</a>
        <span class="crumb-step">&gt;</span><span>新增幻灯片</span></div>
</div>
<div class="result-wrap">
    <div class="result-content">
        <div class="error">
            <?php echo validation_errors(); ?>
        </div>

        <?php echo form_open_multipart(RequestUtil::CM()); ?>
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
                <th>链接：<br>(包括http://)</th>
                <td><input class="common-text" value="<?php echo set_value('href'); ?>"
                           name="href" size="100" type="text"></td>
            </tr>
            <tr>
                <th><i class="require-red">*</i>排序：</th>
                <td><input class="common-text" value="<?php echo set_value('order_sort'); ?>"
                           name="order_sort" size="10" type="text"></td>
            </tr>

            <tr>
                <th><i class="require-red">*</i>图片：</th>
                <td><input name="pic" id="" type="file" class="common-text"></td>
            </tr>

            <tr>
                <th></th>
                <td>
                    <input class="btn btn-primary btn6 mr10" value="提交" type="submit">
                    <a class="btn btn6" href="<?php echo UrlUtil::createBackendUrl('slider/index'); ?>">返回</a>
                </td>
            </tr>
            </tbody>
        </table>
        </form>
    </div>