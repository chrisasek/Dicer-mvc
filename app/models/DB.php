<?php
namespace Models;

class DB
{
	private static $_instance = null;
	private $_pdo,
		$_query,
		$_error = false,
		$_results,
		$_last_id,
		$_count = 0;

	private function __construct()
	{
		try {
			$this->_pdo = new PDO('mysql: host=' . Config::get('mysql/host') . '; dbname=' . Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	// public function __sleep()
	// {
	// 	return array();
	// }

	// public function __wakeup()
	// {
	// 	$this->_pdo = DB::getInstance();
	// }

	public static function getInstance()
	{
		if (!isset(self::$_instance)) {
			self::$_instance = new DB();
		}
		return self::$_instance;
	}

	// sample sql = "SELECT * FROM dbname where name = ?"
	// call query $db  DB::getInstance()
	// if(!$db->query($sql, array('1', '2', '3'))->eror()){
	// return $db->results()	
	//}
	public function query($sql, $params = array())
	{
		$this->_error = false;
		if ($this->_query = $this->_pdo->prepare($sql)) {
			$x = 1;
			if (count($params)) {
				foreach ($params as $param) {
					$this->_query->bindValue($x, $param);
					$x++;
				}
			}
			if ($this->_query->execute()) {
				$this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
				$this->_count = $this->_query->rowCount();
			} else {
				$this->_error = true;
			}
		}
		return $this;
	}
	// call deb $db = DB::getIntance()
	// $act = 'SELECT COUNT['name']'
	// $re = $db->action($act, 'mytable', array('name', '=', 'chris'))

	public function action($action, $table, $where = array())
	{
		if (count($where) == 3) {
			$operators = array('=', '>', '<', '>=', '<=');

			$field = 	$where[0];
			$operator = $where[1];
			$value = 	$where[2];

			if (in_array($operator, $operators)) {
				$sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
				if (!$this->query($sql, array($value))->error()) {
					return $this;
				}
			}
		}
		return false;
	}

	public function countAll($table, $id = null)
	{
		if ($id) {
			$sql = "SELECT COUNT(*) FROM `{$table}` {$id}";
			return $this->query($sql)->results();
		} else {
			return $this->query("SELECT COUNT(*) FROM `{$table}`")->results();
		}
	}
	// Special Pagination SQL

	//  per page is the total you want to show on page
	// offset is the record to skeep at ech fetch 
	// offset = current page - 1 * perpage 

	// where should look like this "WHERE verified = 1"
	// order should look like  this "ORDER BY name DESC"

	public function getPerPage($per_page, $off_set, $table, $where = null, $order = null, $selector = "*")
	{
		$sql = "SELECT {$selector} FROM {$table} {$where} {$order} LIMIT {$per_page} OFFSET {$off_set}";
		if ($this->query($sql)->count()) {
			return  $this->query($sql)->results();
		}
		return false;
	}

	// $db = DB::getInstance
	// $result = $db->get('users', array('id', '>', 'proffnick'));

	// $re = $result->first() 

	//  $re->username //  $re->passo

	public function get($table, $where)
	{
		return $this->action('SELECT *', $table, $where);
	}

	public function delete($table, $where)
	{
		return $this->action('DELETE', $table, $where);
	}
	// pass table name and filds like this
	// array(
	// 'name' => Input::get('username'),
	// 'password' => Hash::make(pass, salt)
	//)
	public function insert($table, $fields = array())
	{
		if (count($fields)) {
			$keys = array_keys($fields);
			$values = '';
			$x = 1;
			foreach ($fields as $field) {
				$values .= '?';
				if ($x < count($fields)) {
					$values .= ', ';
				}
				$x++;
			}
			$sql = "INSERT INTO {$table}(`" . implode('`, `', $keys) . "`) VALUES($values)";

			if (!$this->query($sql, $fields)->error()) {
				$this->_last_id = $this->_pdo->lastInsertId();
				return true;
			}
		}
		return false;
	}

	public function update($table, $id, $fields, $keyfield = 'id')
	{
		$set = '';
		$x = 1;
		foreach ($fields as $name => $value) {
			$set .= "{$name} = ?";
			if ($x < count($fields)) {
				$set .= ', ';
			}
			$x++;
		}
		$sql = "UPDATE {$table} SET {$set} WHERE {$keyfield} = {$id}";
		if (!$this->query($sql, $fields)->error()) {
			//echo 'Successful';
			return true;
		}
		return false;
	}

	public function results()
	{
		return $this->_results;
	}
	public function first()
	{
		return $this->results() ? $this->results()[0] : null;
	}
	public function random($no = null)
	{
		return array_rand($this->results(), $no);
	}
	public function lastInsertId()
	{
		return $this->_last_id;
	}
	public function error()
	{
		return $this->_error;
	}
	public function count()
	{
		return $this->_count;
	}
}
