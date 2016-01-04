<header>
    <h2>心雅提示您</h2>
</header>

<section>
    <div class="result-wrap">
        <div class="result-content">
            <div class="tips F16">
                <?php echo $message; ?>
            </div>
            <?php if ($returnBack): ?>
                <a href="<?php echo $returnBack; ?>">
                    <input class="btn btn6" onClick="history.go(-1)" value="返回" type="button">
                </a>
            <?php else: ?>
                <input class="btn btn6" onClick="history.go(-1)" value="返回" type="button">
            <?php endif; ?>
        </div>
    </div>
</section>