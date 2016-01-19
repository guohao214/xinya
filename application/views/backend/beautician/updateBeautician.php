<link rel="stylesheet" type="text/css" href="<?php echo get_instance()->config->base_url(); ?>static/backend/css/jquery.datetimepicker.css"/>
<script src="<?php echo get_instance()->config->base_url(); ?>static/backend/js/jquery.datetimepicker.js"></script>
<div class="crumb-wrap">
    <div class="crumb-list"><i class="icon-font"></i>
        <a href="<?php echo UrlUtil::createBackendUrl('project/index') ?>">首页</a>
        <span class="crumb-step">&gt;</span>
        <a class="crumb-name" href="<?php echo UrlUtil::createBackendUrl('beautician/index') ?>">美容师管理</a>
        <span class="crumb-step">&gt;</span><span>修改美容师</span></div>
</div>
<div class="result-wrap">
    <div class="result-content">
        <div class="error">
            <?php echo validation_errors(); ?>
        </div>
        <?php echo form_open_multipart(RequestUtil::CM(array('beautician_id' => $beautician['beautician_id']))); ?>
        <table class="insert-tab" width="100%">
            <tbody>
            <tr>
                <th><i class="require-red">*</i>姓名：</th>
                <td>
                    <input class="common-text required" name="name" size="30"
                           value="<?php echo $beautician['name']; ?>" type="text">
                </td>
            </tr>



            <tr>
                <th><i class="require-red">*</i>性别：</th>
                <td>
                    <select class="select" name="sex">
                        <?php $woman = ($beautician['sex'] == '女') ? ' selected="selected"' : ''; ?>
                        <?php $man = ($beautician['sex'] == '男') ? ' selected="selected"' : ''; ?>
                        <option value="女"<?php echo $woman; ?>>女</option>
                        <option value="男"<?php echo $man; ?>>男</option>
                    </select>
                </td>
            </tr>


            <tr>
                <th><i class="require-red">*</i>工作时间：</th>
                <td>
                    <select class="select" name="work_time">
                        <option value="<?php echo BeauticianModel::ALL_DAY; ?>"<?php echo ($beautician['work_time'] == BeauticianModel::ALL_DAY) ? 'selected' : '';?>>全天</option>
                        <option value="<?php echo BeauticianModel::MORNING_SHIFT; ?>"<?php echo ($beautician['work_time'] == BeauticianModel::MORNING_SHIFT) ? 'selected' : '';?>>早班</option>
                        <option value="<?php echo BeauticianModel::NIGHT_SHIFT; ?>"<?php echo ($beautician['work_time'] == BeauticianModel::NIGHT_SHIFT) ? 'selected' : '';?>>晚班</option>
                    </select>
                </td>
            </tr>


            <tr>
                <th width="120"><i class="require-red">*</i>所属店铺：</th>
                <td>
                    <select name="shop_id" class="required select">
                        <?php $this->load->view('backend/shop/shopList', array('selectShop' => $selectShop, 'hideBelongAllShop' => 1)); ?>
                    </select>
                </td>
            </tr>

            <tr>
                <th width="120"><i class="require-red">*</i>加入时间：</th>
                <td>

                    <input class="common-text required" name="join_date" size="20"
                           value="<?php echo $beautician['join_date']; ?>" type="text">
                </td>
            </tr>

            <tr>
                <th><i class="require-red">*</i>头像：</th>
                <td>
                    <img class="project_cover"
                         src="<?php echo UploadUtil::buildUploadDocPath($beautician['avatar'], '200x200'); ?>">
                    <br>
                    <input name="pic" id="" type="file" class="common-text"></td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <input class="btn btn-primary btn6 mr10" value="提交" type="submit">
                    <a class="btn btn6" href="<?php echo UrlUtil::createBackendUrl('beautician/index'); ?>">返回</a>
                </td>
            </tr>
            </tbody>
        </table>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('[name="join_date"]').datetimepicker({
                lang:'ch',
                timepicker:false,
                format:'Y-m-d',
                formatDate:'Y-m-d',
            });
        })
    </script>