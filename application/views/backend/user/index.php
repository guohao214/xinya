<div class="crumb-wrap">
    <div class="crumb-list"><i class="icon-font"></i><a href="index.html">首页</a><span
            class="crumb-step">&gt;</span><span class="crumb-name">账户管理</span></div>
</div>
<div class="search-wrap">
    <div class="search-content">
        <form action="<?php echo UrlUtil::createBackendUrl('user/index'); ?>?" method="get">
            <table class="search-tab">
                <tr>
                    <th width="70">账户名:</th>
                    <td><input class="common-text" placeholder="账户名" type="text"
                               name="user_name" value="<?php echo defaultValue($params['user_name']); ?>"></td>

                    <td><input class="btn btn-primary btn2" type="submit"></td>
                </tr>
            </table>
        </form>
    </div>
</div>
<div class="result-wrap">
        <div class="result-title">
            <div class="result-list">
                <a href="<?php echo UrlUtil::createBackendUrl('user/addUser') ?>">
                    <i class="icon-font"></i>新增账户</a>
            </div>
        </div>
        <div class="result-content">
            <?php if ($users): ?>
                <table class="result-tab" width="100%">
                    <tr>
                        <th>账户名</th>
                        <th width="300">创建时间</th>
                        <th width="300">最后登录时间</th>
                        <th width="200">操作</th>
                    </tr>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user['user_name']; ?></td>
                            <td><?php echo $user['create_time']; ?></td>
                            <td><?php echo $user['last_login_time']; ?></td>
                            <td>
                                <a class="link-change-password btn btn-warning"
                                   href="<?php echo UrlUtil::createBackendUrl('user/changePassword/' . $user['user_id']); ?>">修改密码</a>

                                <a class="link-del btn btn-danger"
                                   href="<?php echo UrlUtil::createBackendUrl('user/deleteUser/' . $user['user_id']); ?>">删除</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <div class="list-page"><?php echo $pages; ?></div>
            <?php else: ?>
                <div class="error">暂无用户</div>
            <?php endif; ?>
        </div>
</div>

<script>
    $(document).ready(function () {
        $('.link-del').on('click', function (e) {
            e.preventDefault();

            if (confirm('确定删除此用户？')) {
                window.location.href = $(this).attr('href');
            }
        })
    })
</script>