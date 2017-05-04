<?php foreach ($projects as $pj): ?>
            <div class="item ">
                <a href="<?php echo UrlUtil::createUrl('project/detail/' . $pj['project_id'] . '/' . $shopId); ?>">
                    <dl>
                        <dt>
                            <img
                                src="<?php echo UploadUtil::buildUploadDocPath($pj['project_cover'], '100x100'); ?>">
                        </dt>
                        <dd>
                            <h3><?php echo $pj['project_name']; ?></h3>
                            <p class="effects F13">服务时限：<?php echo $pj['use_time']; ?>分钟</p>
                            <p class="price F18">
                                <i class="F12 FN">价格</i>￥<?php echo $pj['price']; ?>

                                <!--<cite class="appointment FN">预约</cite><!--<b>103人推荐</b>-->
                            </p>
                            <p class="effects F13">
                                功效：<?php echo (new StringUtil())->substr($pj['effects'], 30); ?></p>
                        </dd>
                    </dl>
                </a>
            </div>
        <?php endforeach; ?>
