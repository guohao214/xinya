<?php $this->load->view('frontend/header'); ?>
<link rel="stylesheet"
      href="<?php echo get_instance()->config->base_url(); ?>static/frontend/css/beautician.css?v=2016020209">
<script type="text/javascript"
        src="<?php echo get_instance()->config->base_url(); ?>static/frontend/js/iscroll.js"></script>
<script type="text/javascript"
        src="<?php echo get_instance()->config->base_url(); ?>static/frontend/js/appointment.js?v=20160225"></script>
<header>
    <h2>预约美容(提示：左右滑动可选择美容师)</h2>
</header>

<input type="hidden" name="project_time" value="<?php echo $project['use_time']; ?>">
<input type="hidden" name="shop_id" value="<?php echo $shopId; ?>">

<section class="section" id="choose-beautician-section">
    <div class="beautician" id="beautician">
        <ul>
            <?php foreach ($beauticians as $beautician): ?>
                <?php //for($i = 0; $i<10; $i++): ?>
                <li class="beautician-avatar">
                    <img src="<?php echo UploadUtil::buildUploadDocPath($beautician['avatar'], '200x200'); ?>"
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


<div id="divMsg">
    <div class="pay">
        <strong>
            <a id="aClose" href="javascript:; " onclick="document.body.id = ''; "></a>
            <span class="F16">请输入联系信息</span>
        </strong>
        <ul>
            <li>
                <samp>联系人</samp>
                <span><input type="text" name="user_name" class="order-text"
                             value="<?php echo $lastOrder['user_name']; ?>"> </span>
            </li>
            <li>
                <a href="#">
                    <samp>手机号</samp>
                    <span><input type="tel" name="phone_number" class="order-text" maxlength="11"
                                 value="<?php echo $lastOrder['phone_number']; ?>"></span>
                </a>
            </li>
        </ul>
        <a class="confirm-appointment payment colorW F16">确定预约</a>
    </div>
</div>

<footer>
    <a class="project_footer F18" onclick="document.body.id = 'msgBody'; ">确定预约</a>
</footer>

</body>
</htmL>