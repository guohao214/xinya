<header>
    <h2>
        美容项目
        <?php if ($shopId) {
            echo "（{$shops[$shopId]}）";
        } ?>
    </h2>
</header>
<section>

    <?php if ($sliders): ?>
        <div class="slider-wrapper theme-default">
            <div id="slider" class="nivoSlider">
                <?php foreach ($sliders as $slider): ?>
                <a href="<?php echo $slider['href']; ?>">
                    <img src="<?php echo UploadUtil::buildUploadDocPath($slider['pic'], '600x600'); ?>"
                         data-thumb="<?php echo UploadUtil::buildUploadDocPath($slider['pic'], '200x200'); ?>"
                         title="<?php echo $slider['title']; ?>" alt=""/>
                    <?php endforeach; ?>
                </a>
            </div>
        </div>
    <?php endif; ?>

    <div class="items">
        <?php foreach ($projects as $key => $project): ?>
            <div class="itemlist loaded">
                <div class="title_index">
                    <span><p class="F16 FB"><?php echo $categories[$key]; ?></p></span>
                </div>
                <?php foreach ($project as $pj): ?>
                    <div class="item ">
                        <a href="<?php echo UrlUtil::createUrl('project/detail/' . $pj['project_id']); ?>">
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
                                        适用皮肤：<?php echo (new StringUtil())->substr($pj['suitable_skin'], 30); ?></p>
                                </dd>
                            </dl>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<script type="text/javascript"
        src="<?php echo get_instance()->config->base_url(); ?>static/frontend/js/jquery.slider.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#slider').nivoSlider();
    });
</script>