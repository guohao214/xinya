<link rel="stylesheet" href="<?php echo get_instance()->config->base_url(); ?>static/frontend/css/weui.min.css">
<link rel="stylesheet" href="<?php echo get_instance()->config->base_url(); ?>static/frontend/css/makers.css">

<header><h2>提现申请</h2></header>
<style>
    .weui-media-box__title {
        text-align: center;
        font-size: 18px;
    }

    .weui-panel:last-of-type {
        margin-bottom: 60px;
    }</style>
<section class="detail">
    <div class="weui-panel weui-panel_access">
        <div class="weui-panel__bd">
            <div class="weui-media-box weui-media-box_text">
                <h4 class="weui-media-box__title">可提现金额<p>
                        <i style="font-size: 20px;color: #942a25"><?php echo $amount ?></i> 元</p></h4>
                <div class="weui-cells"></div>
                <div class="weui-cells__title" style="font-size: 18px;">提现账号</div>
                <div class="weui-cells weui-cells_radio">
                    <?php foreach ($withdrawDepositAccounts as $key => $withdrawDepositAccount): ?>
                        <label class="weui-cell weui-check__label" for="xxx<?php echo $key; ?>">
                            <div class="weui-cell__bd">
                                <p>
                                    <?php echo $withdrawDepositAccount['dpa_account_type'] ?>：
                                    <?php echo $withdrawDepositAccount['dpa_account'] ?>
                                </p>
                            </div>
                            <div class="weui-cell__ft">
                                <input type="radio" class="weui-check" name="dpa_account_type"
                                       id="xxx<?php echo $key; ?>" value="<?php echo $withdrawDepositAccount['mk_dpa_id'] ?>">
                                <span class="weui-icon-checked"></span>
                            </div>
                        </label>
                    <?php endforeach; ?>
                </div>
                <div class="weui-cells"></div>
                <a href="javascript:;" class="weui-btn weui-btn_primary" id="apply_withdraw">申请提现</a>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript"
        src="<?php echo get_instance()->config->base_url(); ?>static/frontend/js/apply_withdraw.js"></script>
