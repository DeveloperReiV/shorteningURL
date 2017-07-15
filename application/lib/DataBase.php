<?php
/**
 * Класс работы с базой данных
 * Class work with database
 */

namespace app\lib;


class DataBase
{
	/**
	 * @var \PDO - хранить экземпляр класса PDO для работы с базой данных
	 * @access private
	 */
	public $dbh;

	/**
	 * @var string - хранит имя класса для возвращаемого объекта класса при работе с базой данных
	 * @access private
	 */
	private $className = 'stdClass';

	public function __construct( $host = DB_HOST, $dbname = DB_NAME, $user = DB_USER, $password = DB_PASSWORD )
	{
		$this->dbh = new \PDO( "mysql:host=$host;dbname=$dbname", $user, $password );
	}

	/**
	 * Задать имя класса объект которого необходимо вернуть как результат запроса к базе данных
	 *
	 * @param className - имя класса
	 * @access public
	 */
	public function setClassName( $className )
	{
		$this->className = $className;
	}

	/**
	 * Выполняет запрос с параметрами и возвращает результат в виде объекта
	 *
	 * @param $statement    - запрос для выполнения
	 * @param array $params - параметры запроса (необязательный параметр)
	 * @access public
	 *
	 * @return object - объект класса соответствующий запрашиваемым данным
	 */
	public function query( $statement, $params = [ ] )
	{
		$stmt = $this->dbh->prepare( $statement );			//подготавливаем запрос
		$stmt->execute( $params );							//выполняем запрос с подстановкой параметров

		return $stmt->fetchAll( \PDO::FETCH_CLASS, $this->className );
	}

	/**
	 * Выполняет запрос с параметрами
	 *
	 * @param $sql
	 * @param array $params
	 *
	 * @return bool
	 */
	public function execute($sql, $params = [])
	{
		$sth = $this->dbh->prepare($sql);
		$result = $sth->execute($params);
		return $result;
	}
}