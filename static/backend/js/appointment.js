$(document).ready(function () {

    var $beautician = $('select[name="beautician_id"]'),
        $appointmentDay = $('select[name="appointment_day"]'),
        $appointmentTimes = $('[name="appointment_times"]'),
        $btnSubmit = $('.btn-primary'),
        $form = $('form'),
        $projectTime = parseInt($('[name="use_time"]').val());


    $btnSubmit.on('click', function() {
        var $chooseAppointTimes = $('.choose-appointment-time'),
            $appointments = [];

        if ($chooseAppointTimes.length < 1) {
            alert('请选择预约时间！');
            return false;
        }

        $chooseAppointTimes.each(function () {
            var $that = $(this);
            $appointments.push($that.attr('data-val'));
        })

        $appointmentTimes.val(encodeURIComponent($appointments.join(',')))


        $form.submit();
    })
    // 美容师点击事件
    $beautician.on('change', function () {
        getAppointmentTimes();
    })

    // 选择预约日期改变时间
    $appointmentDay.on('change', function () {
        getAppointmentTimes();
    })

    // 打开页面，触发第一个美容师的点击事件
    getAppointmentTimes();

    // 选择预约时间
    $('.appointment-times').delegate('.can-appointment', 'click', function () {

        $('.choose-appointment-time').removeClass('choose-appointment-time');

        var $nextAppointmentTimes = $(this).nextUntil('.cant-appointment'),
            $validAppointmentTimes = $nextAppointmentTimes.length * 30 + 30;

        // console.log($validAppointmentTimes);
        if ($validAppointmentTimes < $projectTime) {
            alert('预约时间不够，请重新选择');
        } else {
            $(this).addClass('choose-appointment-time');
            for (var i = 0; i < Math.ceil($projectTime / 30) - 1; i++) {
                $nextAppointmentTimes.eq(i).addClass('choose-appointment-time');
            }
        }

    })

    // 获得预约时间
    function getAppointmentTimes() {
        var $beauticianId = $beautician.val(),
            $day = $appointmentDay.val();

        $.ajax({
            url: '/appointment/getValidAppointmentTime/' + $beauticianId + '/' + $day,
            dataType: 'json',
            beforeSend: function () {
                $('.appointment-times').html();
            },
            success: function (data) {
                $('.appointment-times').html(data.data);
            },
            error: function () {
                alert('获得预约时间失败！');
            }

        })
    }

})

