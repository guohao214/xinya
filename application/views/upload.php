<html>
<head>
    <title>Upload Form</title>
</head>

<style>

    #pagination-digg li { border:0; margin:0; padding:0; font-size:11px; list-style:none; /* savers */ float:left; }
    #pagination-digg a { border:solid 1px #9aafe5; margin-right:2px; }
    #pagination-digg .previous-off,#pagination-digg .next-off  { border:solid 1px #DEDEDE; color:#888888; display:block; float:left; font-weight:bold; margin-right:2px; padding:3px 4px; }
    #pagination-digg .next a,#pagination-digg .previous a { font-weight:bold; }
    #pagination-digg .active { background:#2e6ab1; color:#FFFFFF; font-weight:bold; display:block; float:left; padding:4px 6px; /* savers */ margin-right:2px; }
    #pagination-digg a:link,#pagination-digg a:visited { color:#0e509e; display:block; float:left; padding:3px 6px; text-decoration:none; }
    #pagination-digg a:hover { border:solid 1px #0e509e; }
</style>
<body>

<?php echo $error;?>

<?php echo form_open_multipart('index/index1');?>

<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="upload" />

</form>

</body>
</html>