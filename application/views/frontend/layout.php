<?php $this->load->view('frontend/header'); ?>

<div class="content">
    <?php echo $content; ?>
</div>

<footer>
    <a class="cur" href="<?php echo UrlUtil::createUrl('project/index'); ?>" data-path="project">
        <i></i>
        <span>预约</span>
    </a>
    <a href="<?php echo UrlUtil::createUrl('projectCategory/index'); ?>" data-path="projectCategory">
        <i></i>
        <span>分类</span>
    </a>
    <a href="<?php echo UrlUtil::createUrl('userCenter/order'); ?>" data-path="cart">
        <i></i>
        <span>订单</span>
    </a>
<!--    <a href="--><?php //echo UrlUtil::createUrl('makers/index'); ?><!--" data-path="makers">-->
<!--        <i class="icon iconfont icon-makers"style="background:none;padding-right: 0;-->
<!--        color: #7d7d7d;box-sizing: border-box;padding-top: 7px;">&#xe652;</i>-->
<!--        <span>创客中心</span>-->
<!--    </a>-->
    <a href="<?php echo UrlUtil::createUrl('userCenter/index'); ?>" data-path="userCenter">
        <i></i>
        <span>我的</span>
    </a>
</footer>

</body>

<?php get_instance()->wechatShare(); ?>

</html>