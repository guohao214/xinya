<header>
    <h2>
        美容项目
    </h2>
</header>
<section>

    <?php if ($hdpSliders): ?>
        <div class="slider-wrapper theme-default">
            <div id="slider" class="nivoSlider">
                <?php foreach ($hdpSliders as $slider): ?>
                <?php if ($slider['slider_type'] == SliderModel::SLIDER_TYPE_FLL) continue; ?>
                <a href="<?php echo $slider['href']; ?>">
                    <img src="<?php echo UploadUtil::buildUploadDocPath($slider['pic'], '600x600'); ?>"
                         data-thumb="<?php echo UploadUtil::buildUploadDocPath($slider['pic'], '200x200'); ?>"
                         title="<?php echo $slider['title']; ?>" alt="<?php echo $slider['title']; ?>"/>
                    <?php endforeach; ?>
                </a>
            </div>
        </div>
    <?php endif; ?>
    <?php if ($fllSliders): ?>
    <div id="fll">
        <?php foreach ($fllSliders as $slider): ?>
        <?php if ($slider['slider_type'] == SliderModel::SLIDER_TYPE_HDP) continue; ?>
        <a href="<?php echo $slider['href']; ?>">
            <img src="<?php echo UploadUtil::buildUploadDocPath($slider['pic'], '100x100'); ?>"
                 alt="<?php echo $slider['title']; ?>">
            <div class="fll-name"><?php echo $slider['title']; ?></div>
        </a>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
    <div id="categories">
        <div class="categories-list">
            <?php foreach ($categories as $key => $category): ?>
                <a class="category" data-val="<?php echo $key; ?>"><?php echo $category; ?></a>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="items">
        <?php foreach ($projects as $key => $project): ?>
            <div class="itemlist loaded">
                <div class="title_index">
                    <span><p class="F16 FB <?php echo 'category-list-' . $key; ?> "><?php echo $categories[$key]; ?></p></span>
                </div>
                <?php foreach ($project as $pj): ?>
                    <div class="item ">
                        <a href="<?php echo UrlUtil::createUrl('project/detail/' . $pj['project_id'] . '/' . $shopId); ?>">
                            <dl>
                                <dt>
                                    <img
                                        src="<?php echo UploadUtil::buildUploadDocPath($pj['project_cover'], '100x100'); ?>">
                                </dt>
                                <dd>
                                    <h3><?php echo $pj['project_name']; ?></h3>
                                    <p class="effects F13">服务时限：<?php echo $pj['use_time']; ?>分钟</p>
                                    <p class="price F18">
                                        <i class="F12 FN">价格</i>￥<?php echo $pj['price']; ?>

                                        <!--<cite class="appointment FN">预约</cite><!--<b>103人推荐</b>-->
                                    </p>
                                    <p class="effects F13">
                                        功效：<?php echo (new StringUtil())->substr($pj['effects'], 30); ?></p>
                                </dd>
                            </dl>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<div class="bottom_tools">
    <a id="scrollUp" href="javascript:;" title="飞回顶部"></a>
</div>
<script type="text/javascript"
        src="<?php echo get_instance()->config->base_url(); ?>static/frontend/js/iscroll.js"></script>

<script type="text/javascript"
        src="<?php echo get_instance()->config->base_url(); ?>static/frontend/js/jquery.slider.js"></script>

<script type="text/javascript"
        src="<?php echo get_instance()->config->base_url(); ?>static/frontend/js/index.js?v=20150117"></script>
</script>