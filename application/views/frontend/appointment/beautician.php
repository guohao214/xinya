<?php $this->load->view('frontend/header'); ?>
<link rel="stylesheet"
      href="<?php echo get_instance()->config->base_url(); ?>static/frontend/css/beautician.css?v=20150116">
<script type="text/javascript"
        src="<?php echo get_instance()->config->base_url(); ?>static/frontend/js/iscroll.js"></script>
<script type="text/javascript"
        src="<?php echo get_instance()->config->base_url(); ?>static/frontend/js/appointment.js?v=20150116"></script>
<header>
    <h2>预约美容</h2>
</header>

<input type="hidden" name="project_time" value="<?php echo $project['use_time']; ?>">
<input type="hidden" name="shop_id" value="<?php echo $shopId; ?>">

<section class="section" id="choose-beautician-section">
    <div class="beautician" id="beautician">
        <ul>
            <?php foreach ($beauticians as $beautician): ?>
                <?php //for($i = 0; $i<10; $i++): ?>
                <li class="beautician-avatar">
                    <img src="<?php echo UploadUtil::buildUploadDocPath($beautician['avatar'], '100x100'); ?>"
                         data-val="<?php echo $beautician['beautician_id']; ?>">
                    <p><?php echo $beautician['name']; ?></p>
                </li>
                    <?php //endfor; ?>
            <?php endforeach; ?>
        </ul>
    </div>
</section>

<section class="section-appointment-day">
    <label class="label-appointment-day">预约日期：</label>
    <select class="select" name="appointment-day">
        <?php foreach ($days as $k => $day): ?>
            <option value="<?php echo $k; ?>">
                <?php echo $day; ?>
            </option>
        <?php endforeach; ?>
    </select>
</section>

<section class="section-two appointment-times"></section>

<footer>
    <a class="confirm-appointment project_footer F18">确定预约</a>
</footer>

</body>
</htmL>