<div class="crumb-wrap">
    <div class="crumb-list"><i class="icon-font"></i>
        <a href="<?php echo UrlUtil::createBackendUrl('project/index') ?>">首页</a>
        <span class="crumb-step">&gt;</span>
        <a class="crumb-name" href="<?php echo UrlUtil::createBackendUrl('project/index') ?>">订单管理</a>
        <span class="crumb-step">&gt;</span><span>订单详情</span></div>
</div>
<div class="result-wrap">
    <div class="result-content">
        <h1 class="table-title">订单详情</h1>
        <table class="insert-tab" width="100%">
            <tbody>
            <tr>
                <th width="120">订单号：</th>
                <td width="400">
                    <?php echo $order['order_no']; ?>
                </td>
                <th width="120">预约日期：</th>
                <td>
                    <?php echo $order['appointment_day']; ?>
                </td>
            </tr>

            <tr>
                <th width="120">开始时间：</th>
                <td>
                    <?php echo $order['appointment_start_time']; ?>
                </td>
                <th width="120">结束时间：</th>
                <td>
                    <?php echo $order['appointment_end_time']; ?>
                </td>
            </tr>

            <tr>
                <th width="120">美容师：</th>
                <td>
                    <?php echo $order['beautician_name']; ?>
                </td>
                <th width="120">微信订单号：</th>
                <td>
                    <?php echo $order['transaction_id']; ?>
                </td>
            </tr>

            <tr>
                <th>金额：</th>
                <td>￥<?php echo $order['total_fee']; ?></td>
                <th>订单状态：</th>
                <td><?php echo $order['order_status']; ?></td>
            </tr>

            <tr>
                <th>下单时间：</th>
                <td><?php echo $order['create_time']; ?></td>
                <th>支付时间：</th>
                <td><?php echo $order['pay_time']; ?></td>
            </tr>

            <tr>
                <th>订单门店：</th>
                <td><?php echo ($order['shop_id']) ?$shops[$order['shop_id']] : '所有门店'; ?></td>
                <th>完成时间：</th>
                <td><?php echo $order['complete_time'] ? $order['complete_time'] : '未完成'; ?></td>
            </tr>

            </tbody>
        </table>

        <?php if ($orderProjects): ?>
        <h1 class="table-title">订单项目</h1>
        <?php foreach($orderProjects as $orderProject): ?>
        <table class="insert-tab" width="100%">
                <tr>
                    <th width="120">项目封面：</th>
                    <td width="400"><img class="project_cover"
                             src="<?php echo UploadUtil::buildUploadDocPath($orderProject['project_cover'], '200x200'); ?>"></td>
                    <th width="120">项目名：</th>
                    <td><?php echo $orderProject['project_name']; ?></td>
                </tr>

                <tr>
                    <th width="120">所属分类：</th>
                    <td width="400"><?php echo $orderProject['category_name']; ?></td>
                    <th width="120">使用时间：</th>
                    <td><?php echo $orderProject['project_use_time']; ?> 分钟</td>
                </tr>

                <tr>
                    <th width="120">价格：</th>
                    <td width="400"><?php echo $orderProject['project_price']; ?> 元</td>
                    <th width="120">购买数量：</th>
                    <td colspan="3"><?php echo $orderProject['buy_counts']; ?></td>
                </tr>

                <tr>
                    <th width="120">使用皮肤：</th>
                    <td colspan="3"><?php echo $orderProject['suitable_skin']; ?></td>
                </tr>

                <tr>
                    <th width="120">功效：</th>
                    <td  colspan="3"><?php echo $orderProject['effects']; ?></td>
                </tr>
        </table>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>