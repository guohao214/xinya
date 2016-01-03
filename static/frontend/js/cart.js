$(document).ready(function () {
    var $totalAmount = $('.totalAmount'),
        $totalFee = parseFloat($totalAmount.html());

    $totalAmount.html($totalFee.toFixed(2));

    $('.subProject, .incProject').on('click', function () {
        var $that = $(this),
            $project = $that.siblings('.projectNum'),
            $projectNum = parseInt($project.val()),
            $projectId = parseInt($that.attr('data-id')),
            $price = parseFloat($that.attr('data-price')),
            $inCartPrice = $that.parent().siblings('.in-cart-prices').find('.in-cart-price');

        // 减
        if ($that.hasClass('subProject')) {
            if ($projectNum <= 0) {
                return false;
            } else {
                $.getJSON(document_root + 'cart/deleteCart/' + $projectId, {}, function (data) {
                    if (data.status == 1) {
                        --$projectNum;
                        /*if ($projectNum == 0) {
                         $that.parents('.order_list_dtDiv').fadeOut('slow').remove();
                         }*/

                        $project.val($projectNum);
                        $inCartPrice.html(($projectNum*$price).toFixed(2));
                        $totalFee -= $price;
                        $totalAmount.html($totalFee.toFixed(2));
                    }
                })
            }
        }

        // 加
        if ($that.hasClass('incProject')) {
            $.getJSON(document_root + 'cart/addCart/' + $projectId, {}, function (data) {
                if (data.status == 1) {
                    $project.val(++$projectNum);
                    $inCartPrice.html(($projectNum*$price).toFixed(2))
                    $totalFee += $price;
                    $totalAmount.html($totalFee.toFixed(2));
                }
            })
        }

    })

    //******* 支付 ***********//
    $('.payment').on('click', function (e) {
        e.preventDefault();
        var $user_name = $.trim($('input[name="user_name"]').val()),
            $phone = $.trim($('input[name="phone"]').val()),
            $phoneRegexp  = /^\d{11}$/;

        if (!$user_name) {
            alert('请输入联系人');
            return false;
        }

        if (!$phone) {
            alert('请输入手机号');
            return false;
        }

        if (!$phone.match($phoneRegexp)) {
            alert('手机号只能为11位的数字');
            return false;
        }

        $('#create-order').trigger('submit');
    })
})
