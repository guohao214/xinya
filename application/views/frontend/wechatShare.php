<input type="hidden" name="share_appId" value="<?php echo $shareJsParams["appId"]; ?>">
<input type="hidden" name="share_timeStamp" value="<?php echo $shareJsParams["timestamp"]; ?>">
<input type="hidden" name="share_nonceStr" value="<?php echo $shareJsParams["nonceStr"]; ?>">
<input type="hidden" name="share_signature" value="<?php echo $shareJsParams["signature"]; ?>">

<input type="hidden" name="share_title" value="<?php echo $shareTitle; ?>">
<input type="hidden" name="share_link" value="<?php echo $shareUrl; ?>">
<input type="hidden" name="share_imgUrl" value="<?php echo UrlUtil::getBaseUrl(); ?>static/frontend/images/logo.png">
<input type="hidden" name="share_desc" value="<?php echo $shareDesc; ?>">

<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script src="<?php echo UrlUtil::getBaseUrl(); ?>static/frontend/js/share.js?v=201605122937"></script>