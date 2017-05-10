<div class="crumb-wrap">
    <div class="crumb-list"><i class="icon-font"></i><a
            href="<?php echo UrlUtil::createBackendUrl('project/index'); ?>">首页</a><span
            class="crumb-step">&gt;</span><span class="crumb-name">推广大使申请管理</span></div>
</div>
<!--<div class="search-wrap">
    <div class="search-content">
        <form action="<?php echo UrlUtil::createBackendUrl('makers/index'); ?>?" method="get">
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
        <?php if ($makers): ?>
            <table class="result-tab" width="100%">
                <tr>
                    <th width="120" style=""></th>
                    <th>申请人</th>
                    <th>申请时间</th>
                    <th>申请时的消费金额</th>
                    <th>申请状态</th>
                    <th width="150">操作</th>
                </tr>
                <?php foreach ($makers as $maker): ?>
                    <tr>
                        <td style="text-align: center">
                            <img src="<?php echo $maker['avatar']; ?>" alt="" width="64" height="64">
                        </td>
                        <td><?php echo $maker['nick_name']; ?></td>
                        <td><?php echo $maker['apply_time']; ?></td>
                        <td><?php echo $maker['amount']; ?> 元</td>
                        <td><?php echo $status[$maker['status']]; ?></td>
                        <td>
                            <?php if ($maker['status'] == 0): ?>
                             <a  class="btn btn-sm btn-success"
                                href="<?php echo UrlUtil::createBackendUrl('makers/pass?id=' . $maker['maker_id']); ?>">通过申请</a>

                                <a  class="btn btn-sm btn-warning"
                                href="<?php echo UrlUtil::createBackendUrl('makers/reject?id=' . $maker['maker_id']); ?>">拒绝申请</a>
                            <?php endif; ?>
                        </td>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <div class="list-page"><?php echo $pages; ?></div>
        <?php else: ?>
            <div class="error">暂无申请</div>
        <?php endif; ?>
    </div>
</div>