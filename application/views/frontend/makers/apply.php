<link rel="stylesheet" href="<?php echo get_instance()->config->base_url(); ?>static/frontend/css/weui.min.css">
<link rel="stylesheet" href="<?php echo get_instance()->config->base_url(); ?>static/frontend/css/makers.css">
<style>
    .weui-btn_primary{
        width: 60%;
        margin: 0 auto;
    }

    .wrapper {
        margin-top: 50px;
    }
    .wrapper span {
        display: block;
        width: 80%;
        margin: 0 auto;
        font-size: 18px;
        text-align: center;
        margin-bottom: 30px;
    }
</style>
<header><h2>申请成为推广大使</h2></header>
<section class="detail">
    <div class="wrapper">
        <span>您的消费已满<?php echo $minAmount; ?>元<br>请点击下面的按钮申请成为推广大使</span>
        <a href="javascript:;" class="weui-btn weui-btn_primary" id="confirm-submit">确定申请</a>
    </div>
</section>

<script type="text/javascript"
        src="<?php echo get_instance()->config->base_url(); ?>static/frontend/js/apply_makers.js"></script>
