$(document).ready(function () {
    var $appId = $('input[name="share_appId"]').val(),
        $timeStamp = $('input[name="share_timeStamp"]').val(),
        $nonceStr = $('input[name="share_nonceStr"]').val(),
        $signature = $('input[name="share_signature"]').val(),
        $title = $('input[name="share_title"]').val(),
        $link = $('input[name="share_link"]').val(),
        $imgUrl = $('input[name="share_imgUrl"]').val(),
        $desc = $('input[name="share_desc"]');


    var reWxShareConfig = function() {
        wx.onMenuShareTimeline({
            title: $title, // 分享标题
            link: $link, // 分享链接
            imgUrl: $imgUrl, // 分享图标
            success: function () {
                // 用户确认分享后执行的回调函数
                window.location.href = $link;
                $.toast
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
            }
        });


        // 分享给朋友
        wx.onMenuShareAppMessage({
            title: $title, // 分享标题
            link: $link, // 分享链接
            imgUrl: $imgUrl, // 分享图标
            desc: $('[name="desc"]').val(), // 分享描述
            dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
            success: function () {
                // 用户确认分享后执行的回调函数
                window.location.href = $link;
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
            }
        });

        // 分享到qq
        wx.onMenuShareQQ({
            title: $title, // 分享标题
            desc: $('[name="desc"]').val(), // 分享描述
            link: $link, // 分享链接
            imgUrl: $imgUrl, // 分享图标
            success: function () {
                // 用户确认分享后执行的回调函数
                window.location.href = $link;
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
            }
        });
    }


    $desc.on('keyup', function () {
        reWxShareConfig();
    })




    wx.config({
        debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
        appId: $appId, // 必填，公众号的唯一标识
        timestamp: $timeStamp, // 必填，生成签名的时间戳
        nonceStr: $nonceStr, // 必填，生成签名的随机串
        signature: $signature,// 必填，签名，见附录1
        jsApiList: ['onMenuShareAppMessage', 'onMenuShareTimeline', 'onMenuShareQQ'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
    });

    wx.ready(function(){
        reWxShareConfig();
    })


});