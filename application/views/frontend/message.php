<header>
    <h2>不期而遇美容提示您</h2>
</header>

<section>
    <div class="result-wrap">
        <div class="result-content">
            <div class="tips F14">
                <img src="<?php echo get_instance()->config->base_url(); ?>static/frontend/images/warning.png">
                <br>
                <br>
                <?php echo $message; ?>
                <br>
                <?php if ($returnBack): ?>
                    <a href="<?php echo $returnBack; ?>">
                        <input class="btn btn6" value="返回" type="button">
                    </a>
                <?php else: ?>
                    <input class="btn btn6" onClick="history.go(-1)" value="返回" type="button">
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>