/**
 * Created by GuoHao on 2017/4/4.
 */
$(document).ready(function () {
    var $confirm = $('#confirm-submit');

    $confirm.on('click', function () {
        $.getJSON(document_root + 'makers/apply', {}, function (data) {
            if (data.status == 1) {
                window.location.reload()
            }
            else
                messageTool.show(data.detail || '申请失败，请重试！');
        })
    })
})