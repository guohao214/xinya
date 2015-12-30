<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>心雅美容后台管理</title>
    <link rel="stylesheet" type="text/css"
          href="<?php echo get_instance()->config->base_url(); ?>static/backend/css/admin_login.css"/>
</head>
<body>
<div class="admin_login_wrap">
    <h1>心雅美容后台管理登录</h1>
    <div class="error" style="color: red; text-align: center; margin-bottom: 10px;">
        <?php echo validation_errors(); ?>
        <?php echo $error; ?>
    </div>
    <div class="adming_login_border">
        <div class="admin_input">
            <form method="post">
                <ul class="admin_items">
                    <li>
                        <label for="user">用户名：</label>
                        <input type="text" name="user_name" value="<?php echo set_value('user_name'); ?>" id="user"
                               size="40" class="admin_input_style"/>
                    </li>
                    <li>
                        <label for="pwd">密码：</label>
                        <input type="password" name="password" id="pwd" size="40"
                               class="admin_input_style"/>
                    </li>

                    <li>
                        <label for="pwd">验证码：</label>
                        <input type="text" name="verify_code" size="10"
                               class="admin_input_style"/>
                        <img src="<?php echo UrlUtil::createBackendUrl('login/code'); ?>?<?php echo mt_rand(); ?>"
                             class="image-verify">
                    </li>
                    <li>
                        <input type="submit" tabindex="3" value="提交" class="btn btn-primary"/>
                    </li>
                </ul>
            </form>
        </div>
    </div>
    <p class="admin_copyright">&copy; <?php echo date('Y'); ?> Powered by 心雅美容</p>
</div>
</body>
</html>