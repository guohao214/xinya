$(document).ready(function () {
    var $goodsId = '',
        $userName = $('[name="contact_name"]'),
        $phoneNumber = $('[name="contact_phone"]');
    ;

    $('.do-exchange').on('click', function () {
        document.body.id = 'msgBody';
        var $that = $(this);
        $goodsId = $that.attr('data-id');
    });

    $('.confirm-exchange').on('click', function () {
        var $that = $(this);

        if (!$goodsId) {
            messageTool.show('兑换商品失败！');
            return false;
        }

        // 判断联系人 和 手机
        var $userNameVal = $userName.val();
        if (!$userNameVal) {
            messageTool.show('请输入联系人！');
            $userName.focus();
            return false;
        }

        var $phoneNumberVal = $phoneNumber.val();
        if (!$phoneNumberVal) {
            messageTool.show('请输入手机号！');
            $phoneNumber.focus();
            return false;
        }

        if (!$phoneNumberVal.match(/^1\d{10}$/)) {
            messageTool.show('手机号格式错误！');
            $phoneNumber.focus();
            return false;
        }

        $.ajax({
            url: '/exchange/getExchangeGoods/' + $goodsId,
            dataType: 'json',
            type: 'post',
            data: 'contact_name=' + $userNameVal + '&contact_phone=' + $phoneNumberVal,
            beforeSend: function () {
                $that.attr('disabled', 'disabled');
            },
            success: function (data) {
                messageTool.show(data.detail);
                document.body.id = '';
            },
            error: function () {
                messageTool.show('兑换商品失败！');
            },
            complete: function () {
                $that.removeAttr('disabled');
            }

        })
    })

})

