<?php $this->load->view('frontend/header'); ?>
<link rel="stylesheet"
      href="<?php echo get_instance()->config->base_url(); ?>static/frontend/css/beautician.css?v=2015011402">
<script type="text/javascript"
        src="<?php echo get_instance()->config->base_url(); ?>static/frontend/js/iscroll.js"></script>
<script type="text/javascript"
        src="<?php echo get_instance()->config->base_url(); ?>static/frontend/js/appointment.js"></script>
<header>
    <h2>预约</h2>
</header>

<input type="hidden" name="project_time" value="<?php echo $project['use_time']; ?>">
<input type="hidden" name="shop_id" value="<?php echo $shopId; ?>">

<section class="section" id="choose-beautician-section">
    <div class="beautician" id="beautician">
        <ul>
            <?php foreach ($beauticians as $beautician): ?>
                <li class="beautician-avatar">
                    <img src="<?php echo UploadUtil::buildUploadDocPath($beautician['avatar'], '100x100'); ?>"
                         data-val="<?php echo $beautician['beautician_id']; ?>">
                    <p><?php echo $beautician['name']; ?></p>
                </li>
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

<section class="section-two  appointment-times"></section>

<button class="confirm-appointment">确定预约</button>
<script type="text/javascript">


</script>