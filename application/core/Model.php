<?php

namespace app\core;

use app\lib\DataBase;
use app\models\URL;

class Model
{
	protected static $table;
	protected        $data = [];

	public function __get($key)
	{
		return $this->data[$key];
	}

	public function __set($key, $value)
	{
		$this->data[$key] = $value;
	}

	public function __isset($key)
	{
		return isset($this->data[$key]);
	}

	/**
	 * добавить новую запись в БД
	 *
	 * @return bool
	 */
	public function insert()
	{
		$db = new DataBase();
		$cols = array_keys($this->data);						//формируем массив cols заполненный ключами массива data
		$colsPrepare = array_map(function ($col_name)
		{
			return ':' . $col_name;
		}, $cols);								//перед каждым элементом массива cols добавляем ":"
		$dataExec = [];
		foreach($this->data as $key => $value)
		{
			$dataExec[':' . $key] = $value;
		}
		$sql    = 'INSERT INTO ' . static::$table . ' (' . implode(', ', $cols) . ') VALUES (' . implode(', ', $colsPrepare) . ') ';
		$result = $db->execute($sql, $dataExec);

		return $result;
	}

	/**
	 * Вернуть записи из таблицы значение колонки $column в которых равно $value
	 *
	 * @param $column
	 * @param $value
	 *
	 * @return bool или object
	 */
	public static function findByColumn($column, $value)
	{
		$db = new DataBase();
		$db->setClassName(get_called_class());

		$sql = 'SELECT * FROM ' . static::$table . ' WHERE ' . $column . ' = :value ORDER BY id DESC';
		$res = $db->query($sql, [':value' => $value]);

		if(!empty($res))
		{
			return $res;
		}

		return false;
	}

	/**
	 * Вернуть все записи из таблицы.
	 *
	 * @param $first
	 *
	 * @return object
	 */
	public static function findAll()
	{
		$db = new DataBase();
		$db->setClassName(get_called_class());
		$sql = 'SELECT * FROM ' . static::$table . ' ORDER BY id DESC';

		return $db->query($sql);
	}
}