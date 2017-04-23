/**
 * Created by GuoHao on 2017/4/4.
 */
$(document).ready(function () {
    var $addWithdrawAccount = $('#add_withdraw_account'),
        $addAccountForm = $('.add-account-form');

    $('.mask').on('click', function () {
        $('.add-account-form').fadeOut();
    })

    $addWithdrawAccount.on('click', function () {
        $addAccountForm.fadeIn();
    })

    $('.btn-delete').on('click', function () {
        var $self = $(this),
            $accountId = $self.attr('data-val');

        if (confirm('确定删除此收款账号?')) {
            $.getJSON(document_root + 'makers/deleteWithdrawDepositAccount',
                {id: $accountId}, function (data) {
                    if (data.status == 1) {
                        window.location.reload();
                    }
                    else
                        messageTool.show(data.detail || '提交失败，请重试！');
                })
        }
    })
    
    $('#confirm-submit').on('click', function () {
        var $accountNumber = $('input[name="account_number"]');
        if ($.trim($accountNumber.val()) === '') {
            messageTool.show('请输入收款账号');
            return;
        }

        var $accountType = $('select[name="account_type"]').val();

        $.getJSON(document_root + 'makers/applyWithdrawDepositAccount',
            {accountType: $accountType, accountNumber:$accountNumber.val()}, function (data) {
            if (data.status == 1) {
                window.location.reload();
            }
            else
                messageTool.show(data.detail || '提交失败，请重试！');
        })

    })
})