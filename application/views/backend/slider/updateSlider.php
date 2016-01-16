<div class="crumb-wrap">
    <div class="crumb-list"><i class="icon-font"></i>
        <a href="<?php echo UrlUtil::createBackendUrl('project/index'); ?>">首页</a>
        <span class="crumb-step">&gt;</span>
        <a class="crumb-name" href="<?php echo UrlUtil::createBackendUrl('slider/index') ?>">幻灯片/福利管理</a>
        <span class="crumb-step">&gt;</span><span>修改</span></div>
</div>
<div class="result-wrap">
    <div class="result-content">
        <div class="error">
            <?php echo validation_errors(); ?>
        </div>

        <?php echo form_open_multipart(RequestUtil::CM(array('sliderId' => $slider['slider_id']))); ?>
        <table class="insert-tab" width="100%">
            <tbody>

            <tr>
                <th><i class="require-red">*</i>标题：</th>
                <td>
                    <input class="common-text required" name="title"
                           value="<?php echo $slider['title']; ?>" size="50" type="text">
                </td>
            </tr>
            <tr>
                <th>链接：<br>(包括http://)</th>
                <td><input class="common-text" value="<?php echo $slider['href']; ?>"
                           name="href" size="100" type="text"></td>
            </tr>
            <tr>
                <th><i class="require-red">*</i>排序：</th>
                <td><input class="common-text" value="<?php echo $slider['order_sort']; ?>"
                           name="order_sort" size="10" type="text"></td>
            </tr>

            <tr>
                <th><i class="require-red">*</i>分类：</th>
                <td>
                    <select name="slider_type" class="select">
                        <option value="幻灯片"<?php echo ($slider['slider_type']) == '幻灯片' ? ' selected' : ''; ?>)>幻灯片</option>
                        <option value="福利栏"<?php echo ($slider['slider_type']) == '福利栏' ? ' selected' : ''; ?>>福利栏</option>
                    </select>
                </td>
            </tr>

            <tr>
                <th><i class="require-red">*</i>图片：</th>
                <td>
                    <img class="project_cover"
                         src="<?php echo UploadUtil::buildUploadDocPath($slider['pic'], '200x200'); ?>">
                    <br>
                    <input name="pic" id="" type="file" class="common-text"></td>
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