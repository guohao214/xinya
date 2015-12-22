<div class="crumb-wrap">
    <div class="crumb-list"><i class="icon-font"></i>
        <a href="<?php echo UrlUtil::createBackendUrl('project/index') ?>">首页</a>
        <span class="crumb-step">&gt;</span>
        <a class="crumb-name" href="<?php echo UrlUtil::createBackendUrl('project/index') ?>">项目管理</a>
        <span class="crumb-step">&gt;</span><span>新增项目</span></div>
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
                <th width="120"><i class="require-red">*</i>分类：</th>
                <td>
                    <select name="category_id" class="required select">
                        <option value="">请选择分类</option>
                        <?php foreach($categories as $key=>$category): ?>
                            <option value="<?php echo $key;?>"><?php echo $category;?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th><i class="require-red">*</i>项目标题：</th>
                <td>
                    <input class="common-text required" name="project_name"
                           value="<?php echo set_value('project_name'); ?>" size="50" type="text">
                </td>
            </tr>
            <tr>
                <th>使用时间：</th>
                <td><input class="common-text" value="<?php echo set_value('use_time'); ?>"
                           name="use_time" size="10" type="text"> 分钟</td>
            </tr>
            <tr>
                <th><i class="require-red">*</i>价格：</th>
                <td><input class="common-text" value="<?php echo set_value('price'); ?>"
                           name="price" size="10" type="text"> 元</td>
            </tr>

            <tr>
                <th><i class="require-red">*</i>缩略图：</th>
                <td><input name="pic" id="" type="file" class="common-text"></td>
            </tr>

            <tr>
                <th>适用皮肤：</th>
                <td>
                    <textarea name="suitable_skin"
                              class="common-textarea" rows="5" maxlength="500"><?php echo set_value('suitable_skin'); ?></textarea></td>
            </tr>


            <tr>
                <th>功效：</th>
                <td>
                    <textarea name="effects"
                              class="common-textarea" rows="5" maxlength="500"><?php echo set_value('effects'); ?></textarea></td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <input class="btn btn-primary btn6 mr10" value="提交" type="submit">
                    <a class="btn btn6" href="<?php echo UrlUtil::createBackendUrl('project/index'); ?>">返回</a>
                </td>
            </tr>
            </tbody>
        </table>
        </form>
    </div>