<?php

namespace app\core;

use app\controllers;


class Route
{
	/**
	 * Разбирает URL страницы на части для подключения контроллеров и выполнения соотведствующих методов
	 *
	 * @static
	 * @access public
	 * @throws \Exception
	 */
	public static function start()
	{
		$routes = parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );       //получаем только путь из URL строки
		$routes = explode( '/', $routes );                                  //разбиваем строку запроса через '/'

		//получаем имя контроллера и экшена
		$controller_name = !empty( $routes[1] ) ? $routes[1] : 'Main';
		$action_name     = !empty( $routes[2] ) ? $routes[2] : 'index';

		if( $controller_name != 'favicon.ico' )
		{
			// добавляем префиксы
			$model_name  = $controller_name;
			$controller_name  = $controller_name . 'Controller';
			$action_name = 'action_' . $action_name;

			// подцепляем файл с классом модели (файла модели может и не быть)
			$model_path = MODEL_PATH . $model_name . '.php';
			if( file_exists( $model_path ) )
			{
				require_once "$model_path";
			}

			// подцепляем файл с классом контроллера
			$controller_path = CONTROLLER_PATH . $controller_name . '.php';
			if( file_exists( $controller_path ) )
			{
				require_once "$controller_path";
			}
			else
			{
				//throw new lib\Exception404( "Контроллер $controller_name не найден" );
			}

			// создаем контроллер
			$controller_name = "app\\controllers\\" . $controller_name;
			$controller      = new $controller_name;
			$action          = $action_name;

			if( method_exists( $controller, $action ) )
			{
				$controller->$action();                    // вызываем действие контроллера
			}
			else
			{
				//throw new lib\Exception404( "Метод $action не найден в классе-контроллере $controller_name" );
			}
		}
	}

}