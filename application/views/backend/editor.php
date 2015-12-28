<link rel="stylesheet" href="<?php echo get_instance()->config->base_url(); ?>static/kindeditor/themes/default/default.css" />
<script charset="utf-8" src="<?php echo get_instance()->config->base_url(); ?>static/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="<?php echo get_instance()->config->base_url(); ?>static/kindeditor/lang/zh_CN.js"></script>

<textarea name="<?php echo $editorName; ?>" class="common-textarea" rows="20"><?php echo $content; ?></textarea>
<script>
    var editor;
    KindEditor.ready(function(K) {
        editor = K.create('textarea[name="<?php echo $editorName; ?>"]', {
            uploadJson : '<?php echo UrlUtil::createBackendUrl("upload");?>',
            allowFileManager : false
        });
    });
</script>