<?php

namespace app\core;

use app\lib\DataBase;
use app\models\URL;

class Model
{
	protected static $table;
	protected $data = [];

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
		$cols = array_keys($this->data);												//формируем массив cols заполненный ключами массива data
		$colsPrepare = array_map(function ($col_name){return ':' . $col_name;}, $cols);		//перед каждым элементом массива cols добавляем ":"
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
	 * Вернуть записи из таблицы начиная с $first.
	 * Возвращает колличество записей для отображения на одной странице
	 *
	 * @param $first
	 *
	 * @return object
	 */
	public static function findAll($first = 0)
	{
		$db = new DataBase();
		$db->setClassName(get_called_class());

		if(!empty($first))
		{
			$sql = 'SELECT * FROM ' . static::$table . ' ORDER BY id DESC LIMIT ' . $first . ',' . static::$item_on_page;
		}
		else
		{
			$sql = 'SELECT * FROM ' . static::$table . ' ORDER BY id DESC';
		}

		return $db->query($sql);
	}

	

	/**
	 * Удалить запись из таблицы по ID
	 *
	 * @param $id
	 *
	 * @return bool
	 */
	public static function delete($id)
	{
		$db = new DataBase();

		$sql = 'DELETE FROM ' . static::$table . ' WHERE id = :id';

		return $db->execute($sql, [':id' => $id]);
	}



	/**
	 * обновить запись в БД
	 *
	 * @return bool
	 */
	protected function update()
	{
		$db = new DataBase();
		$data = [];
		$dataExec = [];
		foreach ($this->data as $key=>$value) {
			$dataExec[':' . $key] = $value;
			if ($key == 'id') {
				continue;
			}
			$data[] = $key . ' = :' . $key;
		}
		$sql = 'UPDATE ' . static::$table . ' SET ' . implode(',', $data) . ' WHERE id=:id';

		return  $db->execute($sql, $dataExec);
	}

	/**
	 * Сохраняет добавленный или отредактированный элемент
	 *
	 * @return bool
	 */
	public function save()
	{
		return isset($this->id) ? $this->update() : $this->insert();
	}

	/**
	 * Поиск по таблице
	 *
	 * @param $str
	 *
	 * @return object
	 */
	public static function search($str)
	{
		$db = new DataBase();
		$db->setClassName(get_called_class());

		$sql = "SELECT * FROM " . static::$table . " WHERE concat(header,crt_date,description) LIKE '%$str%'";

		return $db->query($sql);
	}

	/**
	 * Вернуть колличество записей из таблицы значение колонки $column в которых равно $value
	 *
	 * @param $column
	 * @param $value
	 *
	 * @return bool или object
	 */
	public static function getCountItem($column = null, $value = null)
	{
		$db = new DataBase();
		if($column != null && $value != null)
		{
			$sql = 'SELECT COUNT(*) FROM ' . static::$table . ' WHERE ' . $column . ' = :value';
		}
		else
		{
			$sql = 'SELECT COUNT(*) FROM ' . static::$table;
		}
		$res = $db->query($sql, [':value' => $value]);

		if(!empty($res))
		{
			foreach((array)$res[0] as $r)
			{
				return $r;
			}
		}

		return false;
	}


	/**
	 * Вазвращает записи для вывода на одну страницу в которых $colum=value
	 *
	 * @param $column - колонка
	 * @param $value - значение в колонке
	 * @param $first - номер записи с которой необходимо вернуть данные
	 *
	 * @return bool|object
	 */
	public static function findByColumnOnePages($column, $value, $first)
	{
		$db = new DataBase();
		$db->setClassName(get_called_class());

		$sql = 'SELECT * FROM ' . static::$table . ' WHERE ' . $column . ' = :value ORDER BY id DESC LIMIT ' . $first . ',' . static::$item_on_page;
		$res = $db->query($sql, [':value' => $value]);

		if(!empty($res))
		{
			return $res;
		}

		return false;
	}
}