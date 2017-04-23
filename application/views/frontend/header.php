<!DOCTYPE html>
<html>
<head>
    <title><?php echo $this->pageTitle; ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo get_instance()->config->base_url(); ?>static/frontend/css/css.css?v=20170423">
    <link rel="stylesheet" href="<?php echo get_instance()->config->base_url(); ?>static/frontend/css/default.css">
    <link rel="stylesheet" href="<?php echo get_instance()->config->base_url(); ?>static/frontend/css/loading.css?v=20170423">
    <link rel="stylesheet" href="<?php echo get_instance()->config->base_url(); ?>static/frontend/css/slider.css?v=20170423">
    <script type="text/javascript" src="<?php echo get_instance()->config->base_url(); ?>static/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo get_instance()->config->base_url(); ?>static/frontend/js/js.js?v=20170423"></script>
</head>
<script>
    document_root = '/';
</script>
<body>
<div id="load" align="center">
    <img src="<?php echo get_instance()->config->base_url(); ?>static/frontend/images/loading.gif"
         width="30" height="30" align="absmiddle"/>
</div>

<!--
    禁止缓存
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
--!>

<div id="message" align="absmiddle">操作完成</div>