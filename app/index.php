<?php
/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 15-12-13
 * Time: 上午11:56
 */

    define('DOCUMENT_ROOT', __DIR__ . DIRECTORY_SEPARATOR);
    define('UPLOAD_FOLDER', 'upload');

    $_SERVER['CI_ENV'] = 'production';
    include '../index.php';
?>