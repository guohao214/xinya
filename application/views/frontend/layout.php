<?php $this->load->view('frontend/header'); ?>

<div class="content">
    <?php echo $content; ?>
</div>

<footer>
    <a class="cur" href="<?php echo UrlUtil::createUrl('project/index'); ?>" data-path="project">
        <i></i>
        <span>首页</span>
    </a>
    <a href="<?php echo UrlUtil::createUrl('shop/index'); ?>" data-path="shop">
        <i></i>
        <span>店铺</span>
    </a>
    <a href="<?php echo UrlUtil::createUrl('cart/index'); ?>" data-path="cart">
        <i></i>
        <span>购物车</span>
    </a>
    <a href="<?php echo UrlUtil::createUrl('userCenter/index'); ?>" data-path="userCenter">
        <i></i>
        <span>我的</span>
    </a>
</footer>

</body>

</html>