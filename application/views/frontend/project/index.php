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
                         title="" alt=""/>
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
<!--        <div class="categories-list">-->
<!--            --><?php //foreach ($categories as $key => $category): ?>
<!--                <a class="category" data-val="--><?php //echo $key; ?><!--">--><?php //echo $category; ?><!--</a>-->
<!--            --><?php //endforeach; ?>
<!--        </div>-->
    </div>
    <div class="items">
        <?php echo $renderProject;?>
    </div>
</section>


<div class="bottom_tools">
    <a id="scrollUp" href="javascript:;" title="飞回顶部"></a>
</div>
<!--<script type="text/javascript"-->
<!--        src="--><?php //echo get_instance()->config->base_url(); ?><!--static/frontend/js/iscroll.js"></script>-->

<script type="text/javascript"
        src="<?php echo get_instance()->config->base_url(); ?>static/frontend/js/jquery.slider.js"></script>

<script type="text/javascript"
        src="<?php echo get_instance()->config->base_url(); ?>static/frontend/js/index.js?v=20170504"></script>
</script>