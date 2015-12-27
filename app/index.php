<?php
ini_set('session.name', 'xinyaSession');
ini_set('session.save_path', '1;600;' . __DIR__ . '/../session');
ini_set('session.cookie_lifetime',  604800); //7天
ini_set('session.cookie_httponly', 1);
ini_set('session.gc_maxlifetime', ini_get('session.cookie_lifetime') - 1440);
session_start();

define('DOCUMENT_ROOT', __DIR__ . DIRECTORY_SEPARATOR);
define('UPLOAD_FOLDER', 'upload');

$_SERVER['CI_ENV'] = 'production';
include '../index.php';
