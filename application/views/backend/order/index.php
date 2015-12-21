<div class="crumb-wrap">
    <div class="crumb-list"><i class="icon-font"></i><a href="index.html">首页</a><span
            class="crumb-step">&gt;</span><span class="crumb-name">项目管理</span></div>
</div>
<div class="search-wrap">
    <div class="search-content">
        <form action="<?php echo UrlUtil::createBackendUrl('order/index'); ?>?" method="get">
            <table class="search-tab">
                <tr>
                    <th width="120">订单号:</th>
                    <td><input class="common-text" placeholder="订单号"
                               name="order_no" value="<?php echo defaultValue($params['order_no']); ?>" type="text"></td>

                    <th width="70">联系人:</th>
                    <td><input class="common-text" placeholder="联系人"
                               name="user_name" value="<?php echo defaultValue($params['user_name']); ?>" type="text"></td>

                    <th width="70">手机号:</th>
                    <td><input class="common-text" placeholder="联系方式"
                               name="phone" value="<?php echo defaultValue($params['phone']); ?>" type="text"></td>

                    <td><input class="btn btn-primary btn2" type="submit"></td>
                </tr>
            </table>
        </form>

    </div>
</div>
<div class="result-wrap">
    <form name="myform" id="myform" method="post">
        <div class="result-title">
            <div class="result-list"></div>
        </div>
        <div class="result-content">
            <table class="result-tab" width="100%">
                <tr>
                    <th>订单ID</th>
                    <th>订单号</th>
                    <th>联系人</th>
                    <th>联系方式</th>
                    <th>微信订单ID</th>
                    <th>订单状态</th>
                    <th>订单金额</th>
                    <th width="150">下单时间</th>
                    <th width="150">支付时间</th>
                    <th width="150">完成时间</th>
                    <th width="100">操作</th>
                </tr>
                <?php foreach($orders as $order): ?>
                <tr>
                    <td><?php echo $order['order_id']; ?></td>
                    <td><?php echo $order['order_no']; ?></td>
                    <td><?php echo $order['user_name']; ?></td>
                    <td><?php echo $order['phone']; ?></td>
                    <td><?php echo $order['transaction_id']; ?></td>
                    <td><?php echo $order['order_status']; ?></td>
                    <td><?php echo $order['total_fee']; ?></td>
                    <td><?php echo $order['create_time']; ?></td>
                    <td><?php echo $order['pay_time']; ?></td>
                    <td><?php echo $order['complete_time']; ?></td>
                    <td>
                        <a class="link-del" href="#">删除</a>
                        <a class="link-complete" href="#">已完成</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
            <div class="list-page"><?php echo $pages; ?></div>
        </div>
    </form>
</div>