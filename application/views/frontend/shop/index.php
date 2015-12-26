<header>
    <h2>门店</h2>
</header>

<section>
    <?php foreach ($shops as $shop): ?>
        <div class="item ">
            <dl>
                <dt>
                    <img
                        src="<?php echo UploadUtil::buildUploadDocPath($shop['shop_logo'], '100x100'); ?>">
                </dt>
                <dd>
                    <a href="<?php echo UrlUtil::createUrl('project/index/' . $shop['shop_id']) ?>">
                        <h3 class="shop_name"><?php echo $shop['shop_name']; ?>
                            <cite class="FN appointment">预约</cite>
                        </h3>
                    </a>
                    <p class="effects F13 address">地址：<?php echo $shop['address']; ?></p>
                    <p class="effects F13 address">联系人：<?php echo $shop['contacts']; ?></p>
                    <p class="effects F13 address">联系电话：<?php echo $shop['contact_number']; ?></p>
                </dd>
            </dl>
        </div>
    <?php endforeach; ?>
</section>