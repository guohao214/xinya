<?php $this->load->view('frontend/header'); ?>
<script type="text/javascript"
        src="<?php echo get_instance()->config->base_url(); ?>static/frontend/js/iscroll.js"></script>
<header>
    <h2>选择美容师</h2>
</header>

<style type="text/css">

    #scroller, #appionment-time {
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
        height: 100px;
    }

    #scroller ul, #appionment-time ul {
        list-style: none;
        padding: 0;
        margin: 0;
        width: 100%;
        height: 100px;
        text-align: center;
    }

    #scroller li, #appionment-time li {
        display: block;
        float: left;
        width: auto;
        height: 100px;
        background-color: #fafafa;
        font-size: 14px;
        padding: 10px;
    }

    #scroller li img {
        border-radius: 6px;
    }

    .time {
        float: left;
        height: 30px;;
        width: 60px;
        border: 1px solid #CCC;
        margin: 5px;
        text-align: center;
        line-height:30px !important;
        text-align: center !important;
    }

</style>
<section style="padding-bottom: 0px;">
    <div class="result1" id="wrapper">
        <div class="beautician" id="scroller">
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
    <div style="padding: 0px;border:1px solid #CCc; height: 60px;">
        <div class="result" id="wrapper1">
            <div class="beautician" id="appionment-time" style="height: 50px;;">
                <ul>
                    <li style="height: 30px;">2015-10-13</li>
                    <li style="height: 30px;">2015-10-13</li>
                    <li style="height: 30px;">2015-10-13</li>
                    <li style="height: 30px;">2015-10-13</li>
                    <li style="height: 30px;">2015-10-13</li>
                    <li style="height: 30px;">2015-10-13</li>
                    <li style="height: 30px;">2015-10-13</li>
                    <li style="height: 30px;">2015-10-13</li>
                    <li style="height: 30px;">2015-10-13</li>
                    <li style="height: 30px;">2015-10-13</li>
                    <li style="height: 30px;">2015-10-13</li>
                    <li style="height: 30px;">2015-10-13</li>
                </ul>
            </div>
        </div>
    </div>

    <div style="padding:0px 10px; width: 340px; margin:0px auto;overflow: scroll !important;">
        <div class="time">
            <div class="time-date">10:30</div>
        </div>
        <div class="time">
            <div class="time-date">10:30</div>
        </div>
        <div class="time">
            <div class="time-date">10:30</div>
        </div>
        <div class="time">
            <div class="time-date">10:30</div>
        </div>
        <div class="time">
            <div class="time-date">10:30</div>
        </div>
        <div class="time">
            <div class="time-date">10:30</div>
        </div>
        <div class="time">
            <div class="time-date">10:30</div>
        </div>
        <div class="time">
            <div class="time-date">10:30</div>
        </div>
        <div class="time">
            <div class="time-date">10:30</div>
        </div>
        <div class="time">
            <div class="time-date">10:30</div>
        </div>
        <div class="time">
            <div class="time-date">10:30</div>
        </div>
        <div class="time">
            <div class="time-date">10:30</div>
        </div>
        <div class="time">
            <div class="time-date">10:30</div>
        </div>
        <div class="time">
            <div class="time-date">10:30</div>
        </div>
        <div class="time">
            <div class="time-date">10:30</div>
        </div>
        <div class="time">
            <div class="time-date">10:30</div>
        </div>
        <div class="time">
            <div class="time-date">10:30</div>
        </div>

    </div>
</section>
<script type="text/javascript">
    $(document).ready(function () {
//
        var beauticians = $('.beautician img').length;
        var scroolLength = beauticians * 120;
        $('#scroller').css('width', scroolLength + 'px');

        var beauticians = $('#appionment-time li').length;
        var scroolLength = beauticians * 100;
        $('#appionment-time').css('width', scroolLength + 'px');

        var myScroll;
        myScroll = new IScroll('#wrapper', {scrollX: true, scrollY: false, mouseWheel: true});

        var myScroll1;

        myScroll1 = new IScroll('#wrapper1', {scrollX: true, scrollY: false, mouseWheel: true});

        document.addEventListener('touchmove', function (e) {
            e.preventDefault();
        }, false);

    })

</script>