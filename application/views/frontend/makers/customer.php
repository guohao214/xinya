<link rel="stylesheet" href="<?php echo get_instance()->config->base_url(); ?>static/frontend/css/weui.min.css">
<link rel="stylesheet" href="<?php echo get_instance()->config->base_url(); ?>static/frontend/css/makers.css">
<style>.weui-panel{margin-bottom: 60px;}</style>
<header>
    <h2>
        我的会员
    </h2>
</header>

<section class="detail">
    <?php if (count($customers) > 0): ?>
    <div class="weui-panel weui-panel_access">
        <div class="weui-panel__bd">
            <?php foreach ($customers as $customer): ?>
            <a href="javascript:void(0);" class="weui-media-box weui-media-box_appmsg">
                <div class="weui-media-box__hd">
                    <img class="weui-media-box__thumb"
                         src="<?php echo $customer['avatar'] ?>"
                         alt="">
                </div>
                <div class="weui-media-box__bd">
                    <h4 class="weui-media-box__title">昵称：<?php echo $customer['nick_name'] ?></h4>
                    <p class="weui-media-box__desc"><?php echo $customer['province'] ?> <?php echo $customer['city'] ?></p>
                    <p class="weui-media-box__desc">订单数：<?php echo $customer['count_order_id'] ?></p>
                </div>
            </a>
            <?php endforeach;?>
        </div>
        <div class="list-page"><?php echo $pages; ?></div>
    </div>
    <?php else:?>
        <?php get_instance()->noContent('亲， 您暂无会员'); ?>
    <?php endif; ?>
</section>

