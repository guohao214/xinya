$(document).ready(function () {
    var $payParams = $('[name="pay-params"]').val(),
        $payRedirectUrl = $('[name="pay-redirect-url"]').val(),
        $payClick = $('.pay-click');

    function pay() {
        WeixinJSBridge.invoke(
            'getBrandWCPayRequest',
            $.parseJSON(decodeURIComponent($payParams)),
            function (res) {
                if (res.err_msg == 'get_brand_wcpay_request:ok') {
                    window.location.href = $payRedirectUrl;
                } else if (res.err_msg == 'get_brand_wcpay_request:cancel') {
                    //alert('取消支付');
                    return false;
                } else if (res.err_msg == 'get_brand_wcpay_request:fail') {
                    alert('支付失败，请重试');
                } else {
                    return false;
                }
            }
        );
    }

    $payClick.on('click', function () {
        if (!WeixinJSBridge.invoke) {
            alert('您的环境不支持微信支付，请在微信里打开！');
            return false;
        } else {
            if (typeof WeixinJSBridge == "undefined") {
                if (document.addEventListener) {
                    document.addEventListener('WeixinJSBridgeReady', pay, false);
                } else if (document.attachEvent) {
                    document.attachEvent('WeixinJSBridgeReady', pay);
                    document.attachEvent('onWeixinJSBridgeReady', pay);
                }
            } else {
                pay();
            }
        }
    })
})