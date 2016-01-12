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
        width: 100px;
        height:auto;
        background-color: #fafafa;
        font-size: 14px;
        padding: 10px;
    }

    #beautician li img {
        border-radius: 6px;
    }

    .img-choose , .time-choose{
        border:1px solid red !important;
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

<input type="hidden" name="project_time" value="60">
<input type="hidden" name="shop_id" value="1">

<section style="padding-bottom: 0px;margin: 0px;">
    <div class="result1" id="wrapper">
        <div class="beautician" id="beautician">
            <ul>
                <?php foreach ($beauticians as $beautician): ?>
                    <?php for($i=0; $i<10; $i++): ?>
                    <li>
                        <img src="<?php echo UploadUtil::buildUploadDocPath($beautician['avatar'], '100x100'); ?>" data-val="<?php echo $beautician['beautician_id']; ?>">
                        <p><?php echo $beautician['name']; ?></p>
                    </li>
                    <?php endfor; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</section>


<section style="padding:0px; padding-top:15px; padding-bottom: 0px;margin: 0px;">
    <?php $date = date('Y-m-d'); ?>
    <select class="select" name="appointment-day">
        <?php for ($i = 0; $i < 15; $i++): ?>
            <option>
                <?php echo date('Y-m-d', strtotime("{$date} +{$i} day")); ?>
            </option>
        <?php endfor; ?>
    </select>
</section>

<section style="padding-bottom: 0px;" class="appointment-times">

</section>

<button class="confirm-appointment">确定预约</button>
<script type="text/javascript">
    $(document).ready(function () {
//
        //messageTool.show('测试');
        var beauticians = $('.beautician img').length;
        var scroolLength = beauticians * 120;
        $('#scroller').css('width', scroolLength + 'px');

//        var myScroll = new IScroll('#wrapper', {scrollX: true, scrollY: false, mouseWheel: false});

        document.addEventListener('touchmove', function (e) {
            e.preventDefault();
        }, false);


        $('li img').on('click', function() {
            $('.img-choose').removeClass('img-choose');
            $(this).addClass('img-choose');

            getAppointmentTimes();
        })

        $('select[name="appointment-day"]').on('change', function() {
            getAppointmentTimes();
        })


        // 打开页面
        $('li img:first').trigger('click');

        var $projectTime = parseInt($('[name="project_time"]').val());

        $('section').delegate('.can-appointment', 'click', function() {

            $('.time-choose').removeClass('time-choose');

            var $next = $(this).nextUntil('.cant-appointment');
            $time = $next.length * 30 + 30;
            console.log($time);

            if ($time < $projectTime)
            {
                messageTool.show('预约时间不够，请重新选择');
            } else {
                $(this).addClass('time-choose');

                for(var i=0; i<$next.length; i++) {
                    $time = (i+1)*30+30;
                    if ($time> $projectTime)
                        return false;
                    else
                        $next.eq(i).addClass('time-choose');
                }
            }

        })


        // 确定预约
        $('.confirm-appointment').on('click', function() {
            var $beautician_id = $('.img-choose').attr('data-val');
            var $day = $('select[name="appointment-day"]').val();
            var $appoint_times = $('.time-choose');
            var $app = [];

            $appoint_times.each(function() {
                var $this = $(this);
                $app.push($this.attr('data-val'));
            })

            var $shop_id = $('[name="shop_id"]').val();
            window.location.href="/cart/order/" + $shop_id + '/' + $beautician_id + '/' + $day + '/' + encodeURIComponent($app.join(','))
        })

    })

    // 获得预约时间
    function getAppointmentTimes()
    {
        var $beautician_id = $('.img-choose').attr('data-val');
        var $day = $('select[name="appointment-day"]').val();

        $.ajax({
            url:'/appointment/getValidAppointmentTime/' + $beautician_id + '/' + $day,
            dataType: 'json',
            success: function(data) {
                $('.appointment-times').html(data.data);
            },
            error: function(data) {
                $('.appointment-times').html('请重试！');
            }

        })
    }

</script>