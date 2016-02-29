<div class="crumb-wrap">
    <div class="crumb-list"><i class="icon-font"></i><a href="<?php echo UrlUtil::createBackendUrl('customer/index'); ?>">首页</a><span
            class="crumb-step">&gt;</span><span class="crumb-name">客户管理</span></div>
</div>
<div class="search-wrap">
    <div class="search-content">
        <form action="<?php echo UrlUtil::createBackendUrl('customer/index'); ?>?" method="get">
            <table class="search-tab">
                <tr>
                    <th width="70">微信昵称:</th>
                    <td><input class="common-text" placeholder="微信昵称" type="text"
                               name="nick_name" value="<?php echo defaultValue($params['nick_name']); ?>"></td>

                    <td><input class="btn btn-primary btn2" type="submit"></td>
                </tr>
            </table>
        </form>
    </div>
</div>
<div class="result-wrap">
        <div class="result-content">
            <?php if ($customers): ?>
                <table class="result-tab" width="100%">
                    <tr>
                        <th width="110">头像</th>
                        <th>昵称</th>
                        <th>城市</th>
                        <th width="100">省份</th>
                        <th width="100">性别</th>
                        <th width="150">积分</th>
                    </tr>
                    <?php foreach ($customers as $customer): ?>
                        <tr>
                            <td>
                                <img class="cover" src="<?php echo $customer['avatar']; ?>">
                            </td>
                            <td><?php echo $customer['nick_name']; ?></td>
                            <td><?php echo $customer['city']; ?></td>
                            <td><?php echo $customer['province']; ?></td>
                            <td><?php echo $sex[$customer['sex']]; ?></td>
                            <td><?php echo $customer['credits']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <div class="list-page"><?php echo $pages; ?></div>
            <?php else: ?>
                <div class="error">暂无信息</div>
            <?php endif; ?>
        </div>
</div>