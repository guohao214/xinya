<div class="crumb-wrap">
    <div class="crumb-list"><i class="icon-font"></i>
        <a href="<?php echo UrlUtil::createBackendUrl('project/index') ?>">首页</a>
        <span class="crumb-step">&gt;</span>
        <a class="crumb-name" href="<?php echo UrlUtil::createBackendUrl('shop/index') ?>">店铺管理</a>
        <span class="crumb-step">&gt;</span><span>新增店铺</span></div>
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
                <th><i class="require-red">*</i>店铺名：</th>
                <td>
                    <input class="common-text required" name="shop_name"
                           value="<?php echo set_value('shop_name'); ?>" size="50" type="text">
                </td>
            </tr>

            <tr>
                <th>地址：</th>
                <td><input class="common-text" value="<?php echo set_value('address'); ?>"
                           name="address" size="50" type="text"></td>
            </tr>

            <tr>
                <th><i class="require-red">*</i>店铺图片：</th>
                <td><input name="pic" id="" type="file" class="common-text"></td>
            </tr>

            <tr>
                <th>联系人：</th>
                <td><input class="common-text" value="<?php echo set_value('contacts'); ?>"
                           name="contacts" size="50" type="text"></td>
            </tr>

            <tr>
                <th>联系电话：</th>
                <td><input class="common-text" value="<?php echo set_value('contact_number'); ?>"
                           name="contact_number" size="50" type="text"></td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <input class="btn btn-primary btn6 mr10" value="提交" type="submit">
                    <a class="btn btn6" href="<?php echo UrlUtil::createBackendUrl('shop/index'); ?>">返回</a>
                </td>
            </tr>
            </tbody>
        </table>
        </form>
    </div>