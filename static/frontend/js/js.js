/**
 * Created by GuoHao on 2015/12/25.
 */
$(document).ready(function () {
    var $pathName = window.location.pathname;
    try {
        var $firstPath = $pathName.replace(/^\/+/, '').split('/').shift();
        $firstPath = $firstPath.toLowerCase();
    } catch (e) {
        return '';
    }

    var $path = '';
    $('footer a').each(function () {
        $path = $(this).attr('data-path');
        if ($path) {
            $path = $path.toLowerCase();
            if ($firstPath === $path) {
                $('.cur').removeClass('cur');
                $(this).addClass('cur');

            }
        }
    })


    // 绑定全局ajax
    var $document = $(document);
    $document.ajaxStart(function () {
        ajaxNoticeTool.show();
    })

    $document.ajaxComplete(function () {
        ajaxNoticeTool.hide();
    })

    $document.ajaxError(function () {
        messageTool.show('请求失败，请重试！');
    })


    // ************* 返回顶部 **************//
    var $bottomTools = $('.bottom_tools');

    $(window).scroll(function () {
        var scrollHeight = $(document).height(),
            scrollTop = $(window).scrollTop(),
            $windowHeight = $(window).innerHeight();

        scrollTop > 50 ? $("#scrollUp").fadeIn(200).css("display", "block") : $("#scrollUp").fadeOut(200);
        $bottomTools.css("bottom", scrollHeight - scrollTop > $windowHeight ? 40 : $windowHeight + scrollTop + 40 - scrollHeight);
    });

    $('#scrollUp').on('click', function (e) {
        e.preventDefault();
        $('html,body').animate({scrollTop: 0});
    });


});

// ************** 消息提示 *************//
messageTool = {
    show: function ($msg) {
        ajaxNoticeTool.hide();
        $('#message').html($msg).fadeIn('normal', function () {
            messageTool.hide();
        })
    },
    hide: function () {
        setTimeout(function () {
            $('#message').fadeOut();
        }, 1000)
    }
}

// ************** ajax操作提示 ************** //
ajaxNoticeTool = {
    show: function () {
        $('#load').fadeIn();
    },
    hide: function () {
        $('#load').fadeOut();
    }
}