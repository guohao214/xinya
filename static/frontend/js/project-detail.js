/**
 * 预约
 */
$(document).ready(function () {
    $('.project_footer').on('click', function (e) {
        e.preventDefault();
        var $that = $(this),
            $projectId = parseInt($that.attr('data-id'));

        $.getJSON(document_root + 'cart/addCart/' + $projectId, {}, function (data) {
            if (data.status == 1) {
                //messageTool.show('加入购物车成功！');
                window.location.href = $that.attr('href');
            }
        })
    })
})
