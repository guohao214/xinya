<header>
    <h2>个人中心</h2>
</header>

<section>
    <ul class="my_page_mainbody">
        <li>
            <a href="<?php echo UrlUtil::createUrl('exchange/coupon'); ?>">
                <div></div>
                我的积分(<?php echo (int)$customer['credits']; ?>)
            </a>
        </li>

        <li>
            <a href="<?php echo UrlUtil::createUrl('userCenter/coupon'); ?>">
                <div></div>
                我的优惠券
            </a>
        </li>

        <li>
            <a href="<?php echo UrlUtil::createUrl('userCenter/exchangeGoods'); ?>">
                <div></div>
                我的兑换商品
            </a>
        </li>

        <li>
            <a href="<?php echo UrlUtil::createUrl('userCenter/order'); ?>">
                <div></div>
                我的订单
            </a>
        </li>

<!--        <li>-->
<!--            <a href="--><?php //echo UrlUtil::createUrl('userCenter/xinya/xiangmujieshao'); ?><!--">-->
<!--                <div></div>-->
<!--                项目介绍-->
<!--            </a>-->
<!--        </li>-->
        <li>
            <a href="http://mp.weixin.qq.com/s?__biz=MzIzMTE0NzcyOA==&mid=402951674&idx=1&sn=4730b575e71a2d3b3c360588842c31b8&scene=0&previewkey=kzjWVGHlhOXc8Ho8QZ9NKsNS9bJajjJKzz/0By7ITJA=#rd">
                <div></div>
                品牌介绍
            </a>
        </li>
        <li>
            <a href="http://mp.weixin.qq.com/s?__biz=MzIzMTE0NzcyOA==&mid=402942347&idx=1&sn=a01ccb914dd6554874188a08430bea4f&scene=0&previewkey=kzjWVGHlhOXc8Ho8QZ9NKsNS9bJajjJKzz%2F0By7ITJA%3D#rd">
                <div></div>
                关于我们
            </a>
        </li>
<!---->
<!--        <li>-->
<!--            <a href="--><?php //echo UrlUtil::createUrl('userCenter/xinya/ruhuitehui'); ?><!--">-->
<!--                <div></div>-->
<!--                入会特惠-->
<!--            </a>-->
<!--        </li>-->
        <li>
            <span class="F13">联系客服：021-50809608</span>
        </li>
    </ul>
</section>
