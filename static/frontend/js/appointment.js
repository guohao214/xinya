$(document).ready(function () {
//
    //messageTool.show('测试');
    var beauticians = $('.beautician-avatar img').length;
    var scroolLength = beauticians * 120;
    $('#beautician').css('width', scroolLength + 'px');

    new IScroll('#choose-beautician-section', {scrollX: true, scrollY: false, mouseWheel: false});


    $('.beautician-avatar img').on('click', function () {
        $('.choose-beautician').removeClass('choose-beautician');
        $(this).addClass('choose-beautician');

        getAppointmentTimes();
    })

    $('select[name="appointment-day"]').on('change', function () {
        getAppointmentTimes();
    })


    // 打开页面
    $('.beautician-avatar img:first').trigger('click');

    var $projectTime = parseInt($('[name="project_time"]').val());

    $('section').delegate('.can-appointment', 'click', function () {

        $('.choose-appointment-time').removeClass('choose-appointment-time');

        var $next = $(this).nextUntil('.cant-appointment');
        $time = $next.length * 30 + 30;
        console.log($time);

        if ($time < $projectTime) {
            messageTool.show('预约时间不够，请重新选择');
        } else {
            $(this).addClass('choose-appointment-time');

            for (var i = 0; i < $next.length; i++) {
                $time = (i + 1) * 30;
                if ($time > $projectTime)
                    return false;
                else
                    $next.eq(i).addClass('choose-appointment-time');
            }
        }

    })


    // 确定预约
    $('.confirm-appointment').on('click', function () {
        var $beautician_id = $('.choose-beautician').attr('data-val');
        var $day = $('select[name="appointment-day"]').val();
        var $appoint_times = $('.choose-appointment-time');
        var $app = [];

        $appoint_times.each(function () {
            var $this = $(this);
            $app.push($this.attr('data-val'));
        })

        var $shop_id = $('[name="shop_id"]').val();
        window.location.href = "/cart/order/" + $shop_id + '/' + $beautician_id + '/' + $day + '/' + encodeURIComponent($app.join(','))
    })

})

// 获得预约时间
function getAppointmentTimes() {
    var $beautician_id = $('.choose-beautician').attr('data-val');
    var $day = $('select[name="appointment-day"]').val();

    $.ajax({
        url: '/appointment/getValidAppointmentTime/' + $beautician_id + '/' + $day,
        dataType: 'json',
        success: function (data) {
            $('.appointment-times').html(data.data);
        },
        error: function (data) {
            $('.appointment-times').html('请重试！');
        }

    })
}