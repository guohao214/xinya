<?php
ini_set('session.name', 'xinyaSession');
ini_set('session.cookie_lifetime',  604800); //7天
ini_set('session.cookie_httponly', 1);
ini_set('session.gc_maxlifetime', ini_get('session.cookie_lifetime') - 1440);
set_time_limit(60);
session_start();


define('DOCUMENT_ROOT', __DIR__ . DIRECTORY_SEPARATOR);
define('UPLOAD_FOLDER', 'upload');

$_SERVER['CI_ENV'] = 'production';
include './codeigniter.php';
