<?php $this->load->view('frontend/header'); ?>
<script type="text/javascript"
        src="<?php echo get_instance()->config->base_url(); ?>static/frontend/js/iscroll.js"></script>
<header>
    <h2>选择美容师</h2>
</header>

<style type="text/css">

    #beautician {
        position: relative;
        z-index: 1;
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        width: 3000px;
        -webkit-transform: translateZ(0);
        -moz-transform: translateZ(0);
        -ms-transform: translateZ(0);
        -o-transform: translateZ(0);
        transform: translateZ(0);
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        -webkit-text-size-adjust: none;
        -moz-text-size-adjust: none;
        -ms-text-size-adjust: none;
        -o-text-size-adjust: none;
        text-size-adjust: none;
    }

    #beautician ul {
        list-style: none;
        padding: 0;
        margin: 0;
        width: 100%;
        height: 100px;
        text-align: center;
    }

    #beautician li {
        display: block;
        float: left;
        width: auto;
        height: 100px;
        background-color: #fafafa;
        font-size: 14px;
        padding: 10px;
    }

    #beautician li img {
        border-radius: 6px;
    }

    .appointment-time {
        float: left;
        height: 30px;;
        width: 60px;
        border: 1px solid #CCC;
        margin: 5px;
        text-align: center;
        line-height: 30px !important;
        text-align: center !important;
    }
</style>
<section style="padding-bottom: 0px;overflow: hidden !important;">
    <div class="result1" id="wrapper">
        <div class="beautician" id="beautician">
            <ul>
                <?php foreach ($beauticians as $beautician): ?>
                    <li><img src="<?php echo UploadUtil::buildUploadDocPath($beautician['avatar'], '100x100'); ?>"></li>
                    <li><img src="<?php echo UploadUtil::buildUploadDocPath($beautician['avatar'], '100x100'); ?>"></li>
                    <li><img src="<?php echo UploadUtil::buildUploadDocPath($beautician['avatar'], '100x100'); ?>"></li>
                    <li><img src="<?php echo UploadUtil::buildUploadDocPath($beautician['avatar'], '100x100'); ?>"></li>
                    <li><img src="<?php echo UploadUtil::buildUploadDocPath($beautician['avatar'], '100x100'); ?>"></li>
                    <li><img src="<?php echo UploadUtil::buildUploadDocPath($beautician['avatar'], '100x100'); ?>"></li>
                    <li><img src="<?php echo UploadUtil::buildUploadDocPath($beautician['avatar'], '100x100'); ?>"></li>
                    <li><img src="<?php echo UploadUtil::buildUploadDocPath($beautician['avatar'], '100x100'); ?>"></li>
                    <li><img src="<?php echo UploadUtil::buildUploadDocPath($beautician['avatar'], '100x100'); ?>"></li>
                    <li><img src="<?php echo UploadUtil::buildUploadDocPath($beautician['avatar'], '100x100'); ?>"></li>
                    <li><img src="<?php echo UploadUtil::buildUploadDocPath($beautician['avatar'], '100x100'); ?>"></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</section>


<section>
    <?php $date = date('Y-m-d'); ?>
    <select>
        <?php for ($i = 0; $i < 15; $i++): ?>
            <option>
                <?php echo date('Y-m-d', strtotime("{$date} +{$i} day")); ?>
            </option>
        <?php endfor; ?>
    </select>
</section>

<?php
$time = strtotime('2015-01-11 9:00:00');
?>
<section style="padding-bottom: 0px;overflow: hidden !important;clear: both">
    <div id="appointment-date">
        <?php for ($i = 0; $i < 30; $i++): ?>
            <div class="appointment-time">
                <div class="time-date"><?php echo date('H:i', ($time + ($i * 1800))); ?></div>
            </div>
        <?php endfor; ?>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function () {
//
        var beauticians = $('.beautician img').length;
        var scroolLength = beauticians * 120;
        $('#scroller').css('width', scroolLength + 'px');

        var beauticians = $('#appionment-time li').length;
        var scroolLength = beauticians * 120;
        $('#appionment-time').css('width', scroolLength + 'px');

        var myScroll;
        myScroll = new IScroll('#wrapper', {scrollX: true, scrollY: false, mouseWheel: false});

        var myScroll1;

        myScroll1 = new IScroll('#wrapper1', {scrollX: true, scrollY: false, mouseWheel: false});

        document.addEventListener('touchmove', function (e) {
            e.preventDefault();
        }, false);

    })

</script>