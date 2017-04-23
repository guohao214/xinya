/**
 * Created by GuoHao on 2017/4/4.
 */
$(document).ready(function () {
    var $applyWithdraw = $('#apply_withdraw');

    $('input[name="dpa_account_type"]:first').click();

    $applyWithdraw.on('click', function () {
        var $dpaAccountTypeValue = $('input[name="dpa_account_type"]:checked').val();

        $.getJSON(document_root + 'makers/applyWithdrawDeposit', {dpa_id: $dpaAccountTypeValue}, function (data) {
            if (data.status == 1) {
                window.location.href = data.data;
            }
            else
                messageTool.show(data.detail || '订单取消失败，请重试！');
        })
    })
})