<link rel="stylesheet" href="<?php echo get_instance()->config->base_url(); ?>static/frontend/css/weui.min.css">
<link rel="stylesheet" href="<?php echo get_instance()->config->base_url(); ?>static/frontend/css/makers.css">
<style>.weui-panel{margin-bottom: 60px;}</style>
<header>
    <h2>
        我的收入
    </h2>
</header>

<section class="detail">
    <?php if (count($earninies) > 0): ?>
    <div class="weui-panel weui-panel_access">
        <div class="weui-panel__bd">
            <?php foreach ($earninies as $customer): ?>
            <a href="javascript:void(0);" class="weui-media-box weui-media-box_appmsg">
                <div class="weui-media-box__hd">
                    <img class="weui-media-box__thumb"
                         src="<?php echo $customer['avatar'] ?>"
                         alt="">
                </div>
                <div class="weui-media-box__bd">
                    <h4 class="weui-media-box__title">昵称：<?php echo $customer['nick_name'] ?></h4>
                    <p class="weui-media-box__desc">消费：<?php echo $customer['all_amount'] ?> 元</p>
                    <p class="weui-media-box__desc">提成：<?php echo $customer['all_earnings_percent'] ?> 元</p>
                </div>
            </a>
            <?php endforeach;?>
        </div>
        <div class="list-page"><?php echo $pages; ?></div>
    </div>
    <?php else:?>
    <?php get_instance()->noContent('亲，您暂无收入'); ?>
    <?php endif; ?>
</section>

