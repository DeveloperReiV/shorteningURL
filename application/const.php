<?php

define('DS', DIRECTORY_SEPARATOR);					//разделитель
define('SITE_ROOT', $_SERVER['DOCUMENT_ROOT']);		//корень сайта

define('CONTROLLER_PATH', __DIR__ . DS . 'controllers' . DS );		//путь к контроллерам проекта
define('MODEL_PATH', __DIR__ . DS . 'models' . DS );				//путь к моделям проекта
define('VIEW_PATH', __DIR__ . DS . 'views' . DS );					//путь к шаблонам проекта
define('UPLOAD_FILES', __DIR__ . DS . 'upload');					//путь к загружаемым файлам

define('SITE_HOST', 'http://' . $_SERVER['HTTP_HOST']);				//url ссылка сайта
define('DR', __DIR__);												//путь до папки приложения


//параметры подключения к базе данных
define( 'DB_HOST', 'localhost' );
define( 'DB_NAME', 'baseURL' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', '' );



