<link rel="stylesheet" href="<?php echo get_instance()->config->base_url(); ?>static/frontend/css/weui.min.css">
<style>
    html, body {
        height: 100%;
    }

    .content {
        height: calc(100% - 120px);
    }

    .detail {
        background: url("../static/frontend/images/wechat_share.png");
        background-size: 100% 100%;
        height: 100%;
    }

    .customer-name {
        position: absolute;
        font-size: 20px;
        font-weight: bold;
        left: 1000px;
    }

    .qrcode {
        width: 150px;
        height: 150px;
        background-color: rebeccapurple;
        position: absolute;
        left: 1000px;
    }
</style>
<header><h2>推广二维码</h2></header>

<section class="detail">
    <input type="hidden" name="customer_name" value="<?php echo $customerName; ?>">
    <input type="hidden" name="share_url" value="<?php echo $shareUrl; ?>">
</section>

<div class="customer-name"></div>
<div class="qrcode"></div>

<script type="text/javascript"
        src="<?php echo get_instance()->config->base_url(); ?>static/frontend/js/qrcode.js?v=2015011701"></script>
<script>
    var $height = document.documentElement.clientHeight,
        $width = document.documentElement.clientWidth;

    $(document).ready(function () {
        $('.content').height($height - 120);
        $('.customer-name')
            .css('left', ($width * 0.32 ) + 'px')
            .css('top', ($height * 0.3737373737) + 'px')
            .html($('input[name="customer_name"]').val())


        $('.qrcode')
            .css('left', ($width * 0.304 ) + 'px')
            .css('top', ($height * 0.5507703349282297) + 'px');

        $('.qrcode').qrcode(
            {width: 150, height: 150, text: $('input[name="share_url"]').val()}
        )
    })
</script>