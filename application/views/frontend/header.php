<!DOCTYPE html>
<html>
<head>
    <title><?php echo $this->pageTitle; ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <link rel="stylesheet" href="<?php echo get_instance()->config->base_url(); ?>static/frontend/css/css.css?v=2016011401">
    <link rel="stylesheet" href="<?php echo get_instance()->config->base_url(); ?>static/frontend/css/default.css">
    <link rel="stylesheet" href="<?php echo get_instance()->config->base_url(); ?>static/frontend/css/loading.css?v=20160113">
    <link rel="stylesheet" href="<?php echo get_instance()->config->base_url(); ?>static/frontend/css/slider.css">
    <script type="text/javascript" src="<?php echo get_instance()->config->base_url(); ?>static/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo get_instance()->config->base_url(); ?>static/frontend/js/js.js?v=20160113"></script>
</head>
<script>
    document_root = '/';
</script>
<body>
<div id="load" align="center">
    <img src="<?php echo get_instance()->config->base_url(); ?>static/frontend/images/loading.gif"
         width="60" height="60" align="absmiddle"/>'
</div>


<div id="message" align="absmiddle">操作完成</div>