<div class="crumb-wrap">
    <div class="crumb-list"><i class="icon-font"></i>
        <a href="<?php echo UrlUtil::createBackendUrl('project/index'); ?>">首页</a>
        <span class="crumb-step">&gt;</span><span>提示</span></div>
</div>
<div class="result-wrap">
    <div class="result-content">
        <div class="tips">
            <?php echo $message; ?>
        <?php //if ($returnBack): ?>
<!--        <a class="btn btn6" href="--><?php //echo $returnBack; ?><!--">返回</a>-->
        <?php //else: ?>
        <input class="btn btn6" onClick="history.go(-1)" value="返回" type="button">
        <?php //endif; ?>
        </div>

    </div>