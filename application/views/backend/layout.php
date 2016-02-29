<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>不期而遇美容连锁 后台管理</title>
    <link rel="stylesheet" type="text/css" href="<?php echo get_instance()->config->base_url(); ?>static/backend/css/common.css?v=2015010303"/>
    <link rel="stylesheet" type="text/css" href="<?php echo get_instance()->config->base_url(); ?>static/backend/css/main.css?v=2015010302"/>
    <script src="<?php echo get_instance()->config->base_url(); ?>static/jquery.min.js"></script>
</head>
<body>
<div class="topbar-wrap white">
    <div class="topbar-inner clearfix">
        <div class="topbar-logo-wrap clearfix">
            <ul class="navbar-list clearfix">
                <li><a class="on" href="<?php echo UrlUtil::createBackendUrl('project/index'); ?>">首页</a></li>
                <li><a href="<?php echo UrlUtil::createUrl('project/index'); ?>" target="_blank">网站首页</a></li>
            </ul>
        </div>
        <div class="top-info-wrap">
            <ul class="top-info-list clearfix">
                <li><a><?php echo UserUtil::getUserName(); ?></a></li>
                <li><a href="<?php echo UrlUtil::createBackendUrl('user/changePassword/' . UserUtil::getUserId()); ?>">修改密码</a></li>
                <li><a href="<?php echo UrlUtil::createBackendUrl('login/logout'); ?>">退出</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="container clearfix">
    <div class="sidebar-wrap">
        <div class="sidebar-title">
            <h1>菜单</h1>
        </div>
        <div class="sidebar-content">
            <ul class="sidebar-list">
                <li>
                    <a href="#"><i class="icon-font">&#xe003;</i>常用操作</a>
                    <ul class="sub-menu">
                        <?php if (UserUtil::isAdmin()): ?>
                        <li><a href="<?php echo UrlUtil::createBackendUrl('category/index') ?>"><i class="icon-font">
                                    &#xe006;</i>分类管理</a></li>
                        <li><a href="<?php echo UrlUtil::createBackendUrl('project/index') ?>"><i class="icon-font">
                                    &#xe008;</i>项目管理</a></li>
                        <?php endif; ?>

                        <li><a href="<?php echo UrlUtil::createBackendUrl('beautician/index') ?>"><i class="icon-font">
                                    &#xe007;</i>美容师管理</a></li>
                        <li><a href="<?php echo UrlUtil::createBackendUrl('order/index') ?>"><i class="icon-font">
                                    &#xe005;</i>订单管理</a></li>

                        <?php if (UserUtil::isAdmin()): ?>
                        <li><a href="<?php echo UrlUtil::createBackendUrl('user/index') ?>"><i class="icon-font">
                                    &#xe014;</i>用户管理</a></li>
                        <li><a href="<?php echo UrlUtil::createBackendUrl('customer/index') ?>"><i class="icon-font">&#xe060;</i>客户管理</a></li>
                        <li><a href="<?php echo UrlUtil::createBackendUrl('shop/index') ?>"><i class="icon-font">&#xe031;</i>门店管理</a></li>
                        <li><a href="<?php echo UrlUtil::createBackendUrl('slider/index') ?>"><i class="icon-font">&#xe033;</i>幻灯片/福利管理</a></li>
                        <li><a href="<?php echo UrlUtil::createBackendUrl('coupon/index') ?>"><i class="icon-font">&#xe028;</i>优惠券管理</a></li>
                        <li><a href="<?php echo UrlUtil::createBackendUrl('couponCode/index') ?>"><i class="icon-font">&#xe026;</i>优惠码管理</a></li>
                        <li><a href="<?php echo UrlUtil::createBackendUrl('exchangeGoods/index') ?>"><i class="icon-font">&#xe032;</i>兑换商品管理</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php if (UserUtil::isAdmin()): ?>
                <li>
                    <a href="#"><i class="icon-font">&#xe018;</i>系统管理</a>
                    <ul class="sub-menu">
                        <!--<li><a href="<?php echo UrlUtil::createBackendUrl('setting/cleanCache') ?>"><i
                                    class="icon-font">&#xe037;</i>清理缓存</a></li>-->
                        <li><a href="<?php echo UrlUtil::createBackendUrl('tool/index') ?>">
                                <i class="icon-font">&#xe046;</i>数据备份</a></li>
                        <li><a href="<?php echo UrlUtil::createBackendUrl('workTime/index') ?>"><i class="icon-font">&#xe017;</i>工作时间设置</a></li>
                        <!--<li><a href=""><i class="icon-font">&#xe045;</i>数据还原</a></li>-->
                    </ul>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <div class="main-wrap"><?php echo $content; ?></div>
</div>
</body>
</html>