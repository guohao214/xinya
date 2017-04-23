<link rel="stylesheet" href="<?php echo get_instance()->config->base_url(); ?>static/frontend/css/weui.min.css">
<style>
    .weui-cells {
        font-size: 13px;
        margin-top: 0
    }
</style>
<header>
    <h2>
        项目分类
    </h2>
</header>
<section>
    <div class="weui-cells">
        <?php foreach ($categories as $key => $category): ?>
            <a class="weui-cell weui-cell_access" href="<?php echo UrlUtil::createUrl('project/projectList/' . $key)?>">
                <div class="weui-cell__bd">
                    <p><?php echo $category; ?></p>
                </div>
                <div class="weui-cell__ft">
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</section>

