<div class="crumb-wrap">
    <div class="crumb-list"><i class="icon-font"></i><a href="index.html">首页</a><span
            class="crumb-step">&gt;</span><span class="crumb-name">项目管理</span></div>
</div>
<div class="search-wrap">
    <div class="search-content">
        <form action="<?php echo UrlUtil::createBackendUrl('shop/index'); ?>?" method="get">
            <table class="search-tab">
                <tr>
                    <th width="70">店铺名:</th>
                    <td><input class="common-text" placeholder="店铺名" type="text"
                               name="shop_name" value="<?php echo defaultValue($params['shop_name']); ?>"></td>

                    <td><input class="btn btn-primary btn2" type="submit"></td>
                </tr>
            </table>
        </form>
    </div>
</div>
<div class="result-wrap">
    <div class="result-title">
        <div class="result-list">
            <a href="<?php echo UrlUtil::createBackendUrl('shop/addShop') ?>">
                <i class="icon-font"></i>新增项目</a>
        </div>
    </div>
    <div class="result-content">
        <?php if ($shops): ?>
            <table class="result-tab" width="100%">
                <tr>
                    <th width="110">封面</th>
                    <th>店铺名</th>
                    <th width="120">联系人</th>
                    <th width="120">联系电话</th>
                    <th>地址</th>
                    <th width="140">操作</th>
                </tr>
                <?php foreach ($shops as $shop): ?>
                    <tr>
                        <td>
                            <img class="cover"
                                 src="<?php echo UploadUtil::buildUploadDocPath($shop['shop_logo'], '200x200'); ?>">
                        </td>
                        <td><?php echo $shop['shop_name']; ?></td>
                        <td><?php echo $shop['contacts']; ?></td>
                        <td><?php echo $shop['contact_number']; ?></td>
                        <td><?php echo $shop['address']; ?></td>
                        <td>
                            <a class="link-update btn btn-warning"
                               href="<?php echo UrlUtil::createBackendUrl('shop/updateShop/' . $shop['shop_id']); ?>">修改</a>
                            <a class="link-del btn btn-danger"
                               href="<?php echo UrlUtil::createBackendUrl('shop/deleteShop/' . $shop['shop_id']); ?>">删除</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <div class="list-page"><?php echo $pages; ?></div>
        <?php else: ?>
            <div class="error">暂无店铺</div>
        <?php endif; ?>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.link-del').on('click', function (e) {
            e.preventDefault();

            if (confirm('确定删除此店铺？')) {
                window.location.href = $(this).attr('href');
            }
        })
    })
</script>