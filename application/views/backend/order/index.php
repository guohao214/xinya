<div class="crumb-wrap">
    <div class="crumb-list"><i class="icon-font"></i><a
            href="<?php echo UrlUtil::createBackendUrl('project/index'); ?>">首页</a><span
            class="crumb-step">&gt;</span><span class="crumb-name">项目管理</span></div>
</div>
<div class="search-wrap">
    <div class="search-content">
        <form action="<?php echo UrlUtil::createBackendUrl('order/index'); ?>?" method="get">
            <table class="search-tab">
                <tr>
                    <th width="70">门店:</th>
                    <td>
                        <select name="shop_id" class="select">
                            <?php $this->load->view('backend/shop/shopList', array('shops' => $shops, 'selectShop' => $params['shop_id'])); ?>
                        </select>
                    </td>

                    <th width="70">订单类型:</th>
                    <td>
                        <select name="order_status" class="select">
                            <option value="">所有</option>
                            <option value="<?php echo OrderModel::ORDER_PAYED?>"<?php echo ($params['order_status'] == OrderModel::ORDER_PAYED) ? 'selected' : '';?>>已支付</option>
                            <option value="<?php echo OrderModel::ORDER_CANCEL?>"<?php echo ($params['order_status'] == OrderModel::ORDER_CANCEL) ? 'selected' : '';?>>已取消</option>
                            <option value="<?php echo OrderModel::ORDER_NOT_PAY?>"<?php echo ($params['order_status'] == OrderModel::ORDER_NOT_PAY) ? 'selected' : '';?>>未支付</option>
                        </select>
                    </td>

                    <th width="70">订单号:</th>
                    <td><input class="common-text" placeholder="订单号" size="30"
                               name="order_no" value="<?php echo defaultValue($params['order_no']); ?>" type="text">
                    </td>
                    <td><input class="btn btn-primary btn2" type="submit"></td>
                </tr>
            </table>
        </form>

    </div>
</div>
<div class="result-wrap">
    <div class="result-title">
        <div class="result-list"></div>
    </div>
    <div class="result-content">
        <?php if ($orders): ?>
            <table class="result-tab" width="100%">
                <tr>
<!--                    <th>订单ID</th>-->
                    <th width="220">订单号</th>
                    <th>微信订单号</th>
                    <th>预约日期</th>
<!--                    <th>结束时间</th>-->
                    <!--                    <th>微信订单ID</th>-->
                    <th>订单状态</th>
                    <th>订单金额</th>
                    <th>订单门店</th>
                    <th width="150">下单时间</th>
                    <!--                    <th width="150">支付时间</th>-->
                    <!--                    <th width="150">完成时间</th>-->
                    <th width="140">操作</th>
                </tr>
                <?php foreach ($orders as $order): ?>
                    <tr>
<!--                        <td>--><?php //echo $order['order_id']; ?><!--</td>-->
                        <td><?php echo $order['order_no']; ?></td>
                        <td><?php echo $order['transaction_id']; ?></td>
                        <td><?php echo DateUtil::buildDateTime($order['appointment_day'], $order['appointment_start_time']); ?></td>
<!--                        <td>--><?php //echo $order['appointment_start_time']; ?><!--</td>-->
<!--                        <td>--><?php //echo $order['appointment_end_time']; ?><!--</td>-->
                        <!--                    <td>--><?php //echo $order['transaction_id']; ?><!--</td>-->
                        <td><?php echo $order['order_status']; ?></td>
                        <td>￥<?php echo $order['total_fee']; ?></td>
                        <td><?php echo ($order['shop_id']) ? $shops[$order['shop_id']] : '所有门店'; ?></td>
                        <td><?php echo $order['create_time']; ?></td>
                        <!--                    <td>--><?php //echo $order['pay_time']; ?><!--</td>-->
                        <!--                    <td>--><?php //echo $order['complete_time']; ?><!--</td>-->
                        <td>
                            <a class="link-view btn btn-success"
                               href="<?php echo UrlUtil::createBackendUrl('order/orderDetail/' . $order['order_no'] . "/{$limit}"); ?>">详情</a>
                            <a class="link-del btn btn-danger"
                               href="<?php echo UrlUtil::createBackendUrl('order/deleteOrder/' . $order['order_id']); ?>">删除</a>

                            <?php if ($order['order_sign'] == OrderModel::ORDER_PAYED): ?><br>
                                <a class="link-complete btn btn-warning"
                                   href="<?php echo UrlUtil::createBackendUrl('order/CancelOrder/' . $order['order_id']); ?>">取消</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <div class="list-page"><?php echo $pages; ?></div>
        <?php else: ?>
            <div class="error">暂无订单</div>
        <?php endif; ?>
    </div>
</div>


<script>
    $(document).ready(function () {
        $('.link-del').on('click', function (e) {
            e.preventDefault();

            if (confirm('确定删除此订单？')) {
                window.location.href = $(this).attr('href');
            }
        })

        $('.link-complete').on('click', function (e) {
            e.preventDefault();

            if (confirm('确定取消此订单？')) {
                window.location.href = $(this).attr('href');
            }
        })
    })
</script>