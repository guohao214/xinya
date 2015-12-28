/**
 * Created by GuoHao on 2015/12/25.
 */
$(document).ready(function () {
    var $pathName = window.location.pathname;
    try {
        var $firstPath = $pathName.replace(/^\/+/, '').split('/').shift();
    } catch (e) {
        return '';
    }

    var $path = '';
    $('footer a').each(function () {
        $path = $(this).attr('data-path');

        if ($firstPath === $path) {
            $('.cur').removeClass('cur');
            $(this).addClass('cur');

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
});


messageTool = {
    show: function ($message) {
        ajaxNoticeTool.hide();

        setTimeout(function () {
            $('#message').html($message);
            $('#message').fadeIn('normal', function () {
                messageTool.hide();
            })
        })
    },
    hide: function () {
        setTimeout(function () {
            $('#message').fadeOut();
        }, 1000)
    }
}


ajaxNoticeTool = {
    show: function () {
        $('#load').fadeIn();
    },
    hide: function () {
        $('#load').fadeOut();
    }
}

