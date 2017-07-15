<?php

namespace app\models;

use app\core\Model;

class URL extends Model
{
	protected static $table = 'url';

	/**
	 * Создает короткую ссылку
	 *
	 * @param $url
	 *
	 * @return string
	 */
	public static function shortiningURL($url)
	{
		$h = "QqWwEeRrTtYyUuIiOoPpAaSsDdFfGgHhJjKkLlZzXxCcVvBbNnMm1234567890";
		$rand = '';
		$arr_url = parse_url($url);
		
		if($arr_url['port'] || $arr_url['user'] || $arr_url['pass'] || $arr_url['path'] || $arr_url['query'] || $arr_url['fragment'])
		{
			$rand = $arr_url['path'] == '/' ? '' :  '/' . substr(str_shuffle($h), 0, 5);
		}
		
		return $arr_url['scheme'] . '://' . $arr_url['host'] . $rand;
	}

	/**
	 * Проверка URL на правильность
	 *
	 * @param $url
	 *
	 * @return bool
	 */
	public static function inspectionURL($url)
	{
		$reg = '/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:.[A-Z0-9][A-Z0-9_-]*)+):?(d+)?/i';
		if(preg_match($reg,$url))
		{
			return true;
		}
		return false;
	}


}