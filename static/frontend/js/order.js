$(document).ready(function () {
    $('.cancel-order').on('click', function () {
        var $that = $(this),
            $orderId = $that.attr('data-val');

        $.getJSON(document_root + 'userCenter/cancelOrder/' + $orderId, {}, function (data) {
            if (data.status == 1) {
                $that.siblings('.colorW').remove();
                $that.replaceWith('<a class="order-expire">订单已取消</a>');
            }
            else
                messageTool.show(data.detail || '订单取消失败，请重试！');
        })
    })
})