<link rel="stylesheet" type="text/css"
      href="<?php echo get_instance()->config->base_url(); ?>static/backend/css/jquery.datetimepicker.css"/>
<script src="<?php echo get_instance()->config->base_url(); ?>static/backend/js/jquery.datetimepicker.js"></script>
<div class="crumb-wrap">
    <div class="crumb-list"><i class="icon-font"></i>
        <a href="<?php echo UrlUtil::createBackendUrl('project/index'); ?>">首页</a>
        <span class="crumb-step">&gt;</span><span>创客管理</span>
        <span class="crumb-step">&gt;</span><span>设置提成</span></div>
</div>
<div class="result-wrap">
    <div class="result-content">
        <div class="error">
            <?php echo validation_errors(); ?>
        </div>
        <div style="padding: 5px 0; text-align: right">
            <input class="btn btn-success btn6 mr10 btn-add" value="增加">
        </div>

        <?php echo form_open(RequestUtil::CM()); ?>
        <table class="insert-tab" width="100%">
            <tbody>
            <tr style="display: none">
                <td>
                    订单金额大于等于 <input class="common-text required" name="amount[]"
                                    value="" size="10" type="text"> 元，
                    提成为 <input class="common-text required" name="percent[]"
                               value="" size="10" type="text"> %

                    &nbsp;&nbsp;&nbsp;<a class="btn-delete btn-danger btn" href="<?php echo UrlUtil::createBackendUrl('EarningsPercent/deleteEarningPercent/' . $amount); ?>">删除</a>
                </td>
            </tr>
            <?php foreach ($earningPercent as $amount => $percent): ?>
                <tr>
                    <td>
                        订单金额大于等于 <input class="common-text required" name="amount[]"
                                        value="<?php echo $amount; ?>" size="10" type="text"> 元，
                        提成为 <input class="common-text required" name="percent[]"
                                   value="<?php echo $percent * 100 ?>" size="10" type="text"> %

                        &nbsp;&nbsp;&nbsp;<a class="btn-delete btn-danger btn" href="<?php echo UrlUtil::createBackendUrl('EarningsPercent/deleteEarningPercent/' . $amount); ?>">删除</a>
                    </td>
                </tr>
            <?php endforeach; ?>

            <tr>
                <td>
                    <input class="btn btn-primary btn6 mr10" value="提交" type="submit">
                </td>
            </tr>
            </tbody>
        </table>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            
            $('.btn-add').on('click', function () {
                $tr = $('table').find('tr:first').clone();
                $tr.find(':input').val('')
                $tr.attr('data-new', 1);
                $tr.show();
                $('table').find('tr:last').before($tr)
            })
            
            $('table').on('click', '.btn-delete', function (e) {
                e.preventDefault();
                var self = $(this);

                if (confirm('确定删除吗？')) {

                    if (self.closest('tr').attr('data-new') == 1) {
                        self.closest('tr').remove()
                    } else{
                        window.location.href = self.prop('href');
                    }

                }
            })
        })
    </script>