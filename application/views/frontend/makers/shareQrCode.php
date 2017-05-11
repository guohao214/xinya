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

    .use_guide {
        position: absolute;
        right: 17px;
        top: 14px;
        font-size: 12px;
        display: inline-block;
        /* border: 1px solid #ccc; */
        background-color: coral;
        border-radius: 5px;
        padding: 2px 5px;
        color: white;
        cursor: pointer;
    }

    .guide {
        position: fixed;
        left: 0;
        bottom: 0px;
        height: 300px;
        width: 100%;
        background-color: white;
        border-top:1px solid #ccc;
        box-sizing: border-box;
        padding: 10px;
        overflow-y: scroll;
        z-index: 999;
        display: none;
    }

    .maskLayer {
        position: fixed;
        z-index: 998;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background-color: rgba(0,0,0,0.3);
        display: none;
    }

    .guide div {
        margin: 10px 0;
        font-size: 15px;
    }
</style>
<header>
    <h2>推广二维码</h2>
    <span class="use_guide">使用指南</span>
</header>

<section class="detail">
    <input type="hidden" name="customer_name" value="<?php echo $customerName; ?>">
    <input type="hidden" name="share_url" value="<?php echo $shareUrl; ?>">
</section>

<div class="customer-name"></div>
<div class="qrcode"></div>

<div class="maskLayer"></div>
<div class="guide">
    <div>
        <p>1. 我居然是推广大使？</p>
        <p>&nbsp;&nbsp;&nbsp;没错，您已经是不期而遇的推广大使啦。推广大使肩负“健康自我，帮助他人”的美好使命。我们时刻以你为荣哦。</p>
    </div>

    <div>
        <p>2. 怎么使用您的专属推广大使二维码呢？</p>
        <p>&nbsp;&nbsp;&nbsp;长按图片即可保存您的二维码图片至手机相册。如果您想邀请他人，通过微信或者QQ将您的二维码图片发送给他，
            让她长按识别二维码按照提示操作就能完成购买项目。</p>
        <p>&nbsp;&nbsp;&nbsp也可直接点击右上角的“分享”按钮，
            一键将您的二维码名片发送至朋友圈让更多的人受益哦！</p>
    </div>

    <div>
        <p>3. 成为推广大使的好处是？</p>
        <p>&nbsp;&nbsp;&nbsp;当您朋友扫描您的二维码成功购买项目或套餐后，您将获得相应比例返现，
            举手之劳也可以有所收益何乐而不为呢？</p>
        <p>&nbsp;&nbsp;&nbsp分享健康和美本身就快乐：将自己的二维码图片分享到您的社交圈，帮助身边的人重视健康和保养，
            为“全民健康”贡献一份自己的力量。</p>
    </div>
    </div>
</div>

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

        $('.use_guide').on('click', function () {
            $('.maskLayer').add($('.guide')).fadeIn();
        })

        $('.maskLayer').on('click', function () {
            $('.maskLayer').add($('.guide')).fadeOut();
        })
    })
</script>