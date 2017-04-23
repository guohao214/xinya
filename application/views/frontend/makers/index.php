<link rel="stylesheet" href="<?php echo get_instance()->config->base_url(); ?>static/frontend/css/weui.min.css">
<link rel="stylesheet" href="<?php echo get_instance()->config->base_url(); ?>static/frontend/css/makers.css">


<header>
    <h2>
        创客管理
    </h2>
</header>
<section>
    <div class="weui-panel weui-panel_access">
        <div class="weui-panel__bd">
            <a href="javascript:void(0);" class="weui-media-box weui-media-box_appmsg">
                <div class="weui-media-box__hd">
                    <img class="weui-media-box__thumb"
                         src="<?php echo $customer['avatar'] ?>"
                         alt="">
                </div>
                <div class="weui-media-box__bd">
                    <h4 class="weui-media-box__title">昵称：<?php echo $customer['nick_name']?></h4>
                    <p class="weui-media-box__desc"><?php echo $customer['province']?> - <?php echo $customer['city']?></p>
                </div>
            </a>
        </div>
    </div>
</section>
<section>
    <div class="weui-grids">
        <a href="javascript:;" class="weui-grid">
            <div class="weui-grid__icon">
                <?php echo $group['all_amount'] ?>
            </div>
            <p class="weui-grid__label">销售总额（元）</p>
        </a>
        <a href="javascript:;" class="weui-grid">
            <div class="weui-grid__icon">
                <?php echo $group['all_earnings_percent'] ?>
            </div>
            <p class="weui-grid__label">总收入（元）</p>
        </a>
        <a href="<?php echo UrlUtil::createUrl('makers/customer') ?>" class="weui-grid">
            <div class="weui-grid__icon">
                <?php echo $group['all_buyer'] ?>
            </div>
            <p class="weui-grid__label">本店会员数</p>
        </a>
    </div>
</section>
<section>
    <div class="weui-cells">

        <a class="weui-cell weui-cell_access" href="<?php echo UrlUtil::createUrl('makers/customer') ?>">
            <div class="weui-cell__hd"><i class="icon iconfont">&#xe668;</i></div>
            <div class="weui-cell__bd">
                <p>我的会员</p>
            </div>
            <div class="weui-cell__ft"></div>
        </a>
        <a class="weui-cell weui-cell_access" href="<?php echo UrlUtil::createUrl('makers/myShareQrcode') ?>">
            <div class="weui-cell__hd"><i class="icon iconfont">&#xe65f;</i></div>
            <div class="weui-cell__bd">
                <p>推广二维码</p>
            </div>
            <div class="weui-cell__ft"></div>
        </a>
    </div>
    <div class="weui-cells">
        <a class="weui-cell weui-cell_access" href="<?php echo UrlUtil::createUrl('makers/earning') ?>">
            <div class="weui-cell__hd"> <i class="icon iconfont">&#xe664;</i></div>
            <div class="weui-cell__bd">
                <p>我的收入</p>
            </div>
            <div class="weui-cell__ft"></div>
        </a>
    </div>
    <div class="weui-cells" style="margin-bottom: 70px;">
        <a class="weui-cell weui-cell_access" href="<?php echo UrlUtil::createUrl('makers/withdrawDepositAccount') ?>">
            <div class="weui-cell__hd"><i class="icon iconfont">&#xe66b;</i></div>
            <div class="weui-cell__bd">
                <p>提现账号</p>
            </div>
            <div class="weui-cell__ft"></div>
        </a>
        <a class="weui-cell weui-cell_access" href="<?php echo UrlUtil::createUrl('makers/applyWithdrawDeposit') ?>">
            <div class="weui-cell__hd"><i class="icon iconfont">&#xe673;</i></div>
            <div class="weui-cell__bd">
                <p>提现申请</p>
            </div>
            <div class="weui-cell__ft"></div>
        </a>
        <a class="weui-cell weui-cell_access" href="<?php echo UrlUtil::createUrl('makers/withdrawDeposit') ?>">
            <div class="weui-cell__hd"><i class="icon iconfont">&#xe66a;</i></div>
            <div class="weui-cell__bd">
                <p>提现记录</p>
            </div>
            <div class="weui-cell__ft"></div>
        </a>

    </div>
</section>