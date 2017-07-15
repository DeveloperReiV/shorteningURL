<?php
/**
 * Файл начальной загрузки данных
 */

use app\core;

require __DIR__ . '/const.php';
require DR . '/autoload.php';    //файл автозагрузки
require DR . '/lib/DataBase.php';
require DR . '/lib/functions.php';

core\Route::start();

