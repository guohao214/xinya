<div class="crumb-wrap">
    <div class="crumb-list"><i class="icon-font"></i><a
            href="<?php echo UrlUtil::createBackendUrl('project/index'); ?>">首页</a><span
            class="crumb-step">&gt;</span><span class="crumb-name">提成订单管理</span></div>
</div>
<!--<div class="search-wrap">
    <div class="search-content">
        <form action="<?php echo UrlUtil::createBackendUrl('EarningsOrder/index'); ?>?" method="get">
            <table class="search-tab">
                <tr>
                    <th width="70">订单类型:</th>
                    <td>
                        <select name="order_status" class="select">
                            <option value="">所有</option>
                            <option
                                value="<?php echo OrderModel::ORDER_PAYED ?>"<?php echo ($params['order_status'] == OrderModel::ORDER_PAYED) ? 'selected' : ''; ?>>
                                已支付
                            </option>
                            <option
                                value="<?php echo OrderModel::ORDER_CANCEL ?>"<?php echo ($params['order_status'] == OrderModel::ORDER_CANCEL) ? 'selected' : ''; ?>>
                                已取消
                            </option>
                            <option
                                value="<?php echo OrderModel::ORDER_NOT_PAY ?>"<?php echo ($params['order_status'] == OrderModel::ORDER_NOT_PAY) ? 'selected' : ''; ?>>
                                未支付
                            </option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th width="70">订单号:</th>
                    <td><input class="common-text" placeholder="订单号" size="30"
                               name="order_no" value="<?php echo defaultValue($params['order_no']); ?>" type="text">
                    </td>
                    <th width="70">联系人:</th>
                    <td><input class="common-text" placeholder="联系人" size="15"
                               name="user_name" value="<?php echo defaultValue($params['user_name']); ?>" type="text">
                    </td>

                    <th width="70">手机号:</th>
                    <td><input class="common-text" placeholder="手机号" size="15"
                               name="phone_number" value="<?php echo defaultValue($params['phone_number']); ?>"
                               type="text">
                    </td>
                    <td><input class="btn btn-primary btn2" type="submit"></td>
                </tr>
            </table>
        </form>

    </div>
</div> -->
<div class="result-wrap">
    <div class="result-title">
        <div class="result-list"></div>
    </div>
    <div class="result-content">
        <?php if ($orders): ?>
            <table class="result-tab" width="100%">
                <tr>
                    <th width="220">订单号</th>
                    <th>分享者</th>
                    <th>购买者</th>
                    <th>购买项目</th>
                    <th>订单金额</th>
                    <th>提成比例</th>
                    <th>提成金额</th>
                    <th>提现订单</th>
                    <th width="150">订单状态</th>
                </tr>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?php echo $order['order_no']; ?></td>
                        <td><?php echo $order['share_nick_name']; ?></td>
                        <td><?php echo $order['nick_name']; ?></td>
                        <td><?php echo $order['project_name']; ?></td>
                        <td><?php echo $order['order_amount']; ?> 元</td>
                        <td><?php echo $order['order_earnings_percent'] * 100; ?>%</td>
                        <td><?php echo $order['order_amount'] * $order['order_earnings_percent']; ?> 元</td>
                        <td>
                            <?php if ($order['withdraw_deposit_id']): ?>
                             <a TARGET="_blank" href="<?php echo UrlUtil::createBackendUrl('withDrawDeposit/index?id=' . $order['withdraw_deposit_id']); ?>">查看提现订单</a>
                            <?php else: ?>
                            未提现
                            <?php endif; ?>
                        </td>
                        </td>
                        <td><?php echo $order['order_status'] ? '已支付' : "未支付"; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <div class="list-page"><?php echo $pages; ?></div>
        <?php else: ?>
            <div class="error">暂无订单</div>
        <?php endif; ?>
    </div>
</div>