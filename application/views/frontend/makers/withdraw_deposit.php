<link rel="stylesheet" href="<?php echo get_instance()->config->base_url(); ?>static/frontend/css/weui.min.css">
<link rel="stylesheet" href="<?php echo get_instance()->config->base_url(); ?>static/frontend/css/makers.css">

<header><h2> 提现记录</h2></header>
<style>.weui-panel:last-of-type {margin-bottom: 60px; }</style>
<section class="detail">
    <?php if (count($withdrawDeposits) > 0):?>
    <?php foreach ($withdrawDeposits as $withdrawDeposit): ?>
        <div class="weui-panel weui-panel_access">
            <div class="weui-panel__hd"><?php echo $withdrawDeposit['create_time'] ?>
                （<b style="font-size: 15px;color: #0e509e"><?php echo $withdrawDeposit['status'] ?></b>）
            </div>
            <div class="weui-panel__bd">
                <div class="weui-media-box weui-media-box_text">
                    <h4 class="weui-media-box__title">提现金额： <?php echo $withdrawDeposit['dp_amount'] ?> 元</h4>
                    <p class="weui-media-box__desc">
                        提现账号：<?php echo $withdrawDeposit['dp_account_type'] ?> <?php echo $withdrawDeposit['dp_account'] ?></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <?php else: ?>
    <?php get_instance()->noContent('亲， 您暂无提现记录'); ?>
    <?php endif; ?>
</section>

