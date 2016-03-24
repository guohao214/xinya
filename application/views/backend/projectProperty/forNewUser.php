<script src="<?php echo get_instance()->config->base_url(); ?>static/backend/js/projectProperty-newUser.js"></script>
<div class="crumb-wrap">
    <div class="crumb-list"><i class="icon-font"></i>
        <a href="<?php echo UrlUtil::createBackendUrl('project/index'); ?>">首页</a>
        <span class="crumb-step">&gt;</span>
        <a class="crumb-name" href="<?php echo UrlUtil::createBackendUrl('ProjectProperty/projectForNewUserList') ?>">新用户专享项目</a>
        <span class="crumb-step">&gt;</span><span>新增新用户专享项目</span></div>
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
                <th><i class="require-red">*</i>项目分类：</th>
                <td>
                    <select class="select" id="category">
                        <?php foreach ($categories as $key => $category): ?>
                            <option value="<?php echo $key; ?>"><?php echo $category; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>

            <tr>
                <th><i class="require-red">*</i>选择项目：</th>
                <td>
                    <select class="select" name="project_id" id="project_id">
                    </select>
                </td>
            </tr>


            <tr>
                <th></th>
                <td>
                    <input class="btn btn-primary btn6 mr10" value="提交" type="submit">
                    <a class="btn btn6" href="<?php echo UrlUtil::createBackendUrl('ProjectProperty/projectForNewUserList'); ?>">返回</a>
                </td>
            </tr>
            </tbody>
        </table>
        </form>
    </div>

