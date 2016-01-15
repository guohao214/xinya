<?php $this->pageTitle = $project['project_name']; ?>
<?php $this->load->view('frontend/header'); ?>
<script type="text/javascript" src="<?php echo get_instance()->config->base_url(); ?>static/frontend/js/project-detail.js"></script>

<style>
    body {
        background-color: white !important;
    }
</style>
<header>
    <a class="prev j_prePage" href="javascript:window.history.back();"></a>
    <h2><?php echo $project['project_name']; ?></h2>
</header>

<section>
    <div class="project_top">
        <div class="imgArea">
            <img src="<?php echo UploadUtil::buildUploadDocPath($project['project_cover'], '600x600'); ?>">
            <div class="project_price"></div>
        </div>
        <div class="item_b">
            <strong class="hide F18 FB"><?php echo $project['project_name']; ?></strong>
            <p class="F13 price">价格：￥<?php echo $project['price']; ?></p>
            <p>服务时限：<i></i><?php echo $project['use_time']; ?>分钟</p>

        </div>
        <?php if ($project['suitable_skin']): ?>
        <div class="item_desc">
            <p><?php echo $project['suitable_skin']; ?></p>
        </div>
        <?php endif; ?>

        <div class="item_desc">
            <ul class="tags">
                <li class="F15">功效</li>
            </ul>
            <p><?php echo nl2br($project['effects']); ?></p>
        </div>
    </div>
</section>
<footer>
    <a class="project_footer F18" data-id="<?php echo $project['project_id']; ?>"
       href="<?php echo UrlUtil::createUrl("appointment/index/{$shopId}") ?>">预约</a>
</footer>

</body>
</html>