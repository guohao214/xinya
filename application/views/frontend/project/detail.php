<!DOCTYPE html>
<html>
<head>
    <title><?php echo $project['project_name']; ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo get_instance()->config->base_url(); ?>static/frontend/css/css.css">
    <link rel="stylesheet" href="<?php echo get_instance()->config->base_url(); ?>static/frontend/css/default.css">
    <script type="text/javascript" src="<?php echo get_instance()->config->base_url(); ?>static/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo get_instance()->config->base_url(); ?>static/frontend/js/footer.js"></script>
</head>
<body>
<header>
    <a class="prev j_prePage" href="javascript:window.history.back();"></a>
    <h2><?php echo $project['project_name']; ?> 详情</h2>
</header>
<section>
    <div class="project_top">
        <div class="imgArea">
            <img src="<?php echo UploadUtil::buildUploadDocPath($project['project_cover'], '600x600'); ?>">
            <div class="project_price"></div>
        </div>
        <div class="item_b">
            <strong class="hide F18 FB"><?php echo $project['project_name']; ?></strong>
            <p>价格：￥<?php echo $project['price']; ?></p>
            <p>服务时限：<i></i><?php echo $project['use_time']; ?>分钟</p>

        </div>
        <div class="item_desc">
            <ul class="tags">
                <li class="F12">适用皮肤</li>
            </ul>
            <p><?php echo $project['suitable_skin']; ?></p>
        </div>

        <div class="item_desc">
            <ul class="tags">
                <li class="F12">功效</li>
            </ul>
            <p><?php echo $project['effects']; ?></p>
        </div>
    </div>
</section>
<footer>
    <a href="#" class="project_footer F18">预约</a>
</footer>
</body>
</html>