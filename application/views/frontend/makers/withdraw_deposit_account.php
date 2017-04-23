<link rel="stylesheet" href="<?php echo get_instance()->config->base_url(); ?>static/frontend/css/weui.min.css">
<link rel="stylesheet" href="<?php echo get_instance()->config->base_url(); ?>static/frontend/css/makers.css">

<header><h2>提现账号管理</h2></header>
<style>
    .weui-btn_warn {
        padding: 0 5px;
        line-height: 20px;
        vertical-align: middle;
    }
    #add_withdraw_account {
        text-align: center;
        padding: 10px 0;
        font-size: 15px;
        text-decoration: underline;
        color: #0e509e;
    }

    .mask {
        position: fixed;
        height: 200%;
        width: 200%;
        z-index: 998;
        background-color: rgba(0,0,0,0.5);
    }

    .add-account-form {
        display: none;
    }

</style>
<section class="detail" style="overflow-y: scroll";>
    <?php if (count($accountList) > 0): ?>
    <?php foreach ($accountList as $account): ?>
        <div class="weui-cells">
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <p><?php echo $account['dpa_account_type'] ?>：<?php echo $account['dpa_account'] ?></p>
                </div>
                <div class="weui-cell__ft">
                    <a href="javascript:;" class="weui-btn weui-btn_mini weui-btn_warn btn-delete"
                       data-val="<?php echo $account['mk_dpa_id'] ?>">删除</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <?php else:?>
    <?php get_instance()->noContent('提现账号为空，请添加'); ?>
    <?php endif; ?>

</section>

<div style="text-align: center;  padding: 10px 0 70px">
    <a href="javascript:;" class="" id="add_withdraw_account">增加提现账号</a>
</div>



<div class="weui-cells add-account-form"
     style="position: fixed; top: 0;width: 100%; height:100%;
     margin-top: 0; z-index:999; background-color: transparent">

    <div class="mask"></div>

    <div class="form" style="z-index: 1000; background-color: white; width: 100%; position: fixed">
        <div class="weui-cell">
            <div class="weui-cell__hd">
                <label class="weui-label">收款方</label></div>
            <div class="weui-cell__bd">
                <select class="weui-select" name="account_type">
                    <option value="支付宝">支付宝</option>
                    <option value="微信">微信</option>
                </select>
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">收款账号</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text"  placeholder="收款账号" name="account_number">
            </div>
        </div>
        <div class="weui-cell">
            <a href="javascript:;" class="weui-btn weui-btn_primary" id="confirm-submit">提交</a>
        </div>
    </div>
</div>
<script type="text/javascript"
        src="<?php echo get_instance()->config->base_url(); ?>static/frontend/js/apply_withdraw_account.js"></script>
