<div class="crumb-wrap">
    <div class="crumb-list"><i class="icon-font"></i><a href="<?php echo UrlUtil::createBackendUrl('withDrawDeposit/index'); ?>">首页</a><span
            class="crumb-step">&gt;</span><span class="crumb-name">提现管理</span></div>
</div>
<!--<div class="search-wrap">-->
<!--    <div class="search-content">-->
<!--        <form action="--><?php //echo UrlUtil::createBackendUrl('customer/index'); ?><!--?" method="get">-->
<!--            <table class="search-tab">-->
<!--                <tr>-->
<!--                    <th width="70">微信昵称:</th>-->
<!--                    <td><input class="common-text" placeholder="微信昵称" type="text"-->
<!--                               name="nick_name" value="--><?php //echo defaultValue($params['nick_name']); ?><!--"></td>-->
<!---->
<!--                    <td><input class="btn btn-primary btn2" type="submit"></td>-->
<!--                </tr>-->
<!--            </table>-->
<!--        </form>-->
<!--    </div>-->
<!--</div>-->
<div class="result-wrap">
        <div class="result-content">
            <?php if ($withDrawDeposits): ?>
                <table class="result-tab" width="100%">
                    <tr>
                        <th>ID</th>
                        <th>昵称</th>
                        <th>提现金额</th>
                        <th>收款方式</th>
                        <th>收款账号</th>
                        <th width="">状态</th>
                        <th width="150">操作</th>
                    </tr>
                    <?php foreach ($withDrawDeposits as $withDrawDeposit): ?>
                        <tr>
                            <td>
                                <?php echo $withDrawDeposit['mk_dp_id']; ?>
                            </td>
                            <td>
                                <?php echo $withDrawDeposit['nick_name']; ?>
                            </td>
                            <td><?php echo $withDrawDeposit['dp_amount']; ?></td>
                            <td><?php echo $withDrawDeposit['dp_account_type']; ?></td>
                            <td><?php echo $withDrawDeposit['dp_account']; ?></td>
                            <td>
                                <?php echo $withDrawDeposit['status']; ?>
                                <?php if ($withDrawDeposit['_status'] == 1): ?>
                                    <p style="color: red">(<?php echo $withDrawDeposit['reject_reason']; ?>)</p>
                                <?php endif;?>
                            </td>
                            <td>
                                <?php if ($withDrawDeposit['_status'] == 3): ?>
                                <a class="btn btn-success btn-pass"
                                   href="<?php echo UrlUtil::createBackendUrl('withDrawDeposit/pass/' . $withDrawDeposit['mk_dp_id'] .'/' . $limit); ?>">通过</a>
                                <a class="link-del btn btn-danger btn-reject"
                                   href="<?php echo UrlUtil::createBackendUrl('withDrawDeposit/reject/' . $withDrawDeposit['mk_dp_id']); ?>">拒绝</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <div class="list-page"><?php echo $pages; ?></div>
            <?php else: ?>
                <div class="error">暂无信息</div>
            <?php endif; ?>
        </div>
</div>

<script>
    $(document).ready(function () {
        $('.btn-pass').on('click', function (e) {
            e.preventDefault();

            if (confirm('确定已打款？')) {
                window.location.href = $(this).attr('href');
            }
        })

        $('.btn-reject').on('click', function (e) {
            e.preventDefault();

            var $reason = '';

            if ($reason = prompt('请输入拒绝理由')) {
                $href = $(this).attr('href');
                $.getJSON($href, {'reason': $reason}, function (data) {
                    if (data.status == 1)
                        window.location.reload();
                    else
                        alert(data.message|| '操作失败')
                })
            }
        })
    })
</script>