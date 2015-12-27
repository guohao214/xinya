<?php
/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 2015/12/27
 * Time: 13:35
 */

$dir = __DIR__ . '/../session';

$char = array_merge(range('a', 'z'), range(0,9));
foreach ($char as $item) {
    mkdir($dir . DIRECTORY_SEPARATOR . $item, 600, true);
}