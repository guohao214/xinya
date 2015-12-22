<div class="crumb-wrap">
    <div class="crumb-list"><i class="icon-font"></i>
        <a href="<?php echo UrlUtil::createBackendUrl('project/index') ?>">首页</a>
        <span class="crumb-step">&gt;</span>
        <a class="crumb-name" href="<?php echo UrlUtil::createBackendUrl('user/index') ?>">账户管理</a>
        <span class="crumb-step">&gt;</span><span>修改密码</span></div>
</div>
<div class="result-wrap">
    <div class="result-content">
        <div class="error">
            <?php echo validation_errors(); ?>
        </div>

        <?php echo form_open(RequestUtil::CM(array('user_id' => $user['user_id']))); ?>
        <table class="insert-tab" width="100%">
            <tbody>
            <tr>
                <th><i class="require-red">*</i>账户名：</th>
                <td><?php echo $user['user_name']; ?></td>
            </tr>

            <tr>
                <th><i class="require-red">*</i>密码：</th>
                <td><input class="common-text"  name="password" size="20" type="password"></td>
            </tr>

            <tr>
                <th><i class="require-red">*</i>确认密码：</th>
                <td><input class="common-text"  name="re_password" size="20" type="password"></td>
            </tr>

            <tr>
                <th></th>
                <td>
                    <input class="btn btn-primary btn6 mr10" value="提交" type="submit">
                    <a class="btn btn6" href="<?php echo UrlUtil::createBackendUrl('user/index'); ?>">返回</a>
                </td>
            </tr>
            </tbody>
        </table>
        </form>
    </div>