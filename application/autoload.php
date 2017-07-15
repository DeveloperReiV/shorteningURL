<?php

/**
 * Файл автозагрузки
 */

spl_autoload_register( 'my_autoload' );		//регистрируем функцию "my_autoload()" в качестве функции для автозагрузки

function my_autoload( $class )
{

	$classParts = explode('\\', $class);
	$classParts[0] = __DIR__;
	$path = implode(DIRECTORY_SEPARATOR, $classParts).'.php';
	if (file_exists($path)) {
		require_once "$path";
	}
}