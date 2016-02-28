$(document).ready(function () {

    $('.do-get-coupon').on('click', function () {
        var $that = $(this),
            $couponId = $that.attr('data-id');

        if (!$couponId) {
            messageTool.show('领取优惠券失败！');
            return false;
        }

        $.ajax({
            url: '/exchange/getCoupon/' + $couponId,
            dataType: 'json',
            beforeSend: function () {
                $that.attr('disabled', 'disabled');
            },
            success: function (data) {
                messageTool.show(data.detail);
            },
            error: function () {
                messageTool.show('领取优惠券失败！');
            },
            complete:function() {
                $that.removeAttr('disabled');
            }

        })
    })

})

