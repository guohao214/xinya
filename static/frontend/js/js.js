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

positionTool = {
    position: function ($ele) {
        var $scrollTop = document.body.scrollTop,
            $screenHeight = window.screen.height,
            $screenWidth = window.screen.width;

        var $eleWidth = $ele.width(),
            $eleHeight = $ele.height();

        $ele.css('top', ($scrollTop + $screenHeight / 2) - $eleHeight + 'px');
        $ele.css('left', ($screenWidth - $eleWidth) / 2 + 'px');
    }
}


messageTool = {
    show: function ($msg) {
        //计算位置
        positionTool.position($('#message'));
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

ajaxNoticeTool = {
    show: function () {
        //计算位置
        positionTool.position($('#load'));
        $('#load').fadeIn();
    },
    hide: function () {
        $('#load').fadeOut();
    }
}

