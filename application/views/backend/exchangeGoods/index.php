<div class="crumb-wrap">
    <div class="crumb-list"><i class="icon-font"></i><a
            href="<?php echo UrlUtil::createBackendUrl('project/index'); ?>">首页</a><span
            class="crumb-step">&gt;</span><span class="crumb-name">兑换商品管理</span></div>
</div>
<div class="search-wrap">
    <div class="search-content">
        <form action="<?php echo UrlUtil::createBackendUrl('exchangeGoods/index'); ?>?" method="get">
            <table class="search-tab">
                <tr>
                    <th width="100">兑换商品名称:</th>
                    <td><input class="common-text" placeholder="兑换商品名称" type="text"
                               name="exchange_goods_name" value="<?php echo defaultValue($params['exchange_goods_name']); ?>"></td>

                    <td><input class="btn btn-primary btn2" type="submit"></td>
                </tr>
            </table>
        </form>
    </div>
</div>
<div class="result-wrap">
    <div class="result-title">
        <div class="result-list">
            <a href="<?php echo UrlUtil::createBackendUrl('exchangeGoods/addExchangeGoods') ?>">
                <i class="icon-font"></i>新增兑换商品</a>
        </div>
    </div>
    <div class="result-content">
        <?php if ($exchangeGoods): ?>
            <table class="result-tab" width="100%">
                <tr>
                    <th></th>
                    <th>兑换商品名称</th>
                    <th>兑换门店</th>
                    <th>兑换的积分</th>
                    <th>发布数量</th>
                    <th>可用数量</th>
                    <th width="100">开始使用时间</th>
                    <th width="100">过期时间</th>
                    <th width="150">添加时间</th>
                    <th width="150">操作</th>
                </tr>
                <?php foreach ($exchangeGoods as $goods): ?>
                    <tr>
                        <td>
                            <img class="cover"
                                 src="<?php echo UploadUtil::buildUploadDocPath($goods['exchange_goods_pic'], '200x200'); ?>">
                        </td>
                        <td><?php echo $goods['exchange_goods_name']; ?></td>
                        <td><?php echo $shops[$goods['exchange_shop_id']]; ?></td>
                        <td><?php echo $goods['exchange_credits']; ?></td>
                        <td><?php echo $goods['total_number']; ?></td>
                        <td><?php echo $goods['remain_number']; ?></td>
                        <td><?php echo $goods['start_time']; ?></td>
                        <td><?php echo $goods['expire_time']; ?></td>
                        <td><?php echo $goods['create_time']; ?></td>
                        <td>
                            <a class="link-update btn btn-warning"
                               href="<?php echo UrlUtil::createBackendUrl('exchangeGoods/updateExchangeGoods/' . $goods['exchange_goods_id'] ."/{$limit}"); ?>">修改</a>
                            <a class="link-del btn btn-danger"
                               href="<?php echo UrlUtil::createBackendUrl('exchangeGoods/deleteExchangeGoods/' . $goods['exchange_goods_id']."/{$limit}"); ?>">删除</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <div class="list-page"><?php echo $pages; ?></div>
        <?php else: ?>
            <div class="error">暂无兑换商品</div>
        <?php endif; ?>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.link-del').on('click', function (e) {
            e.preventDefault();

            if (confirm('确定删除此优惠券？')) {
                window.location.href = $(this).attr('href');
            }
        })
    })
</script>