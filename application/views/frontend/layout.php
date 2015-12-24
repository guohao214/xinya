<!DOCTYPE html>
<html>
<head>
    <title>心雅美容</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo get_instance()->config->base_url(); ?>static/frontend/css/css.css">
    <link rel="stylesheet" href="<?php echo get_instance()->config->base_url(); ?>static/frontend/css/default.css">
    <script type="text/javascript" src="<?php echo get_instance()->config->base_url(); ?>static/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo get_instance()->config->base_url(); ?>static/frontend/js/footer.js"></script>
</head>
<body>

<?php var_dump(RequestUtil::CM()); ?>
<div class="content">
    <?php echo $content; ?>
</div>
<footer>
    <a class="cur" href="<?php echo UrlUtil::createUrl('xinya/index'); ?>" data-path="xinya">
        <i></i>
        <span>预约</span>
    </a>
    <a href="<?php echo UrlUtil::createUrl('shop/index'); ?>" data-path="shop">
        <i></i>
        <span>店铺</span>
    </a>
    <a href="" data-path="order">
        <i></i>
        <span>订单</span>
    </a>
    <a href="" data-path="user">
        <i></i>
        <span>我的</span>
    </a>
</footer>


</body>

</html>