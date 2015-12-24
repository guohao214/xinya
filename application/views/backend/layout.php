<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <link rel="stylesheet" type="text/css" href="<?php echo ViewUtil::getBackendStaticPath() ?>css/common.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo ViewUtil::getBackendStaticPath() ?>css/main.css"/>
    <script src="<?php echo ViewUtil::getBackendStaticPath() ?>js/jquery.min.js"></script>
</head>
<body>
<div class="topbar-wrap white">
    <div class="topbar-inner clearfix">
        <div class="topbar-logo-wrap clearfix">
            <h1 class="topbar-logo none"><a href="index.html" class="navbar-brand">后台管理</a></h1>
            <ul class="navbar-list clearfix">
                <li><a class="on" href="index.html">首页</a></li>
                <li><a href="http://www.17sucai.com/" target="_blank">网站首页</a></li>
            </ul>
        </div>
        <div class="top-info-wrap">
            <ul class="top-info-list clearfix">
                <li><a href="#">管理员</a></li>
                <li><a href="#">修改密码</a></li>
                <li><a href="#">退出</a></li>
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
                        <li><a href="<?php echo UrlUtil::createBackendUrl('category/index') ?>"><i class="icon-font">
                                    &#xe006;</i>分类管理</a></li>
                        <li><a href="<?php echo UrlUtil::createBackendUrl('project/index') ?>"><i class="icon-font">
                                    &#xe008;</i>项目管理</a></li>
                        <li><a href="<?php echo UrlUtil::createBackendUrl('order/index') ?>"><i class="icon-font">
                                    &#xe005;</i>订单管理</a></li>
                        <li><a href="<?php echo UrlUtil::createBackendUrl('user/index') ?>"><i class="icon-font">
                                    &#xe014;</i>用户管理</a></li>
                        <!--<li><a href=""><i class="icon-font">&#xe033;</i>留言管理</a></li>-->
                        <li><a href="<?php echo UrlUtil::createBackendUrl('shop/index') ?>"><i class="icon-font">&#xe031;</i>门店管理</a></li>
                        <li><a href="<?php echo UrlUtil::createBackendUrl('article/index') ?>"><i class="icon-font">&#xe051;</i>文章管理</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe018;</i>系统管理</a>
                    <ul class="sub-menu">
                        <!--<li><a href="<?php echo UrlUtil::createBackendUrl('setting/cleanCache') ?>"><i
                                    class="icon-font">&#xe037;</i>清理缓存</a></li>-->
                        <li><a href="<?php echo UrlUtil::createBackendUrl('tool/index') ?>">
                                <i class="icon-font">&#xe046;</i>数据备份</a></li>
                        <!--<li><a href="system.html"><i class="icon-font">&#xe017;</i>系统设置</a></li>
                        <li><a href=""><i class="icon-font">&#xe045;</i>数据还原</a></li>-->
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-wrap"><?php echo $content; ?></div>
</div>
</body>
</html>