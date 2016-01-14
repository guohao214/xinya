$(document).ready(function () {

    var $beauticianAvatar = $('.beautician-avatar img'),
        $appointmentDay = $('select[name="appointment-day"]'),
        $projectTime = parseInt($('[name="project_time"]').val()),
        $confirmAppointment = $('.confirm-appointment');
    ;

    // 美容师滚动
    $('#beautician').width(($beauticianAvatar.length) * 100);
    new IScroll('#choose-beautician-section', {scrollX: true, scrollY: false, mouseWheel: false});

    // 美容师点击事件
    $beauticianAvatar.on('click', function () {
        $('.choose-beautician').removeClass('choose-beautician');
        $(this).addClass('choose-beautician');

        getAppointmentTimes();
    })

    // 选择预约日期改变时间
    $appointmentDay.on('change', function () {
        getAppointmentTimes();
    })

    // 打开页面，触发第一个美容师的点击事件
    $beauticianAvatar.eq(0).trigger('click');

    // 选择预约时间
    $('.appointment-times').delegate('.can-appointment', 'click', function () {

        $('.choose-appointment-time').removeClass('choose-appointment-time');

        var $nextAppointmentTimes = $(this).nextUntil('.cant-appointment'),
            $validAppointmentTimes = $nextAppointmentTimes.length * 30 + 30;

        // console.log($validAppointmentTimes);
        if ($validAppointmentTimes < $projectTime) {
            messageTool.show('预约时间不够，请重新选择');
        } else {
            $(this).addClass('choose-appointment-time');
            for (var i = 0; i < Math.ceil($projectTime / 30) - 1; i++) {
                $nextAppointmentTimes.eq(i).addClass('choose-appointment-time');
            }
        }

    })

    // 确定预约
    $confirmAppointment.on('click', function () {
        var $beauticianId = parseInt($('.choose-beautician').attr('data-val')),
            $day = $appointmentDay.val(),
            $chooseAppointTimes = $('.choose-appointment-time'),
            $appointments = [],
            $shopId = parseInt($('[name="shop_id"]').val());

        if ($chooseAppointTimes.length == 0) {
            messageTool.show('请选择预约时间！');
            return false;
        }

        $chooseAppointTimes.each(function () {
            var $that = $(this);
            $appointments.push($that.attr('data-val'));
        })

        var $redirectUrl = '/cart/order/';
        $redirectUrl += $shopId + '/';
        $redirectUrl += $beauticianId + '/';
        $redirectUrl += $day + '/' + encodeURIComponent($appointments.join(','));

        window.location.href = $redirectUrl;
    })

    // 获得预约时间
    function getAppointmentTimes() {
        var $beauticianId = parseInt($('.choose-beautician').attr('data-val')),
            $day = $appointmentDay.val();

        $.ajax({
            url: '/appointment/getValidAppointmentTime/' + $beauticianId + '/' + $day,
            dataType: 'json',
            beforeSend: function () {
                $('.appointment-times').html();
            },
            success: function (data) {
                $('.appointment-times').html(data.data);
                $confirmAppointment.show();
            },
            error: function () {
                $confirmAppointment.hide();
                messageTool.show('获得预约时间失败！');
            }

        })
    }

})

