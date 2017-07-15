<?php
/**
 * Файл начальной загрузки данных
 */

use app\core;

require __DIR__ . DIRECTORY_SEPARATOR . 'const.php';
require DR . DS .'autoload.php';    //файл автозагрузки
require DR . DS .'lib' . DS . 'DataBase.php';
require DR . DS .'lib' . DS . 'functions.php';

core\Route::start();

